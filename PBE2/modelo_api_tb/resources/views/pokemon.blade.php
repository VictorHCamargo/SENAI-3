<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex - {{ $pokemon['name'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --type-normal: #A8A878; --type-fire: #F08030; --type-water: #6890F0;
            --type-grass: #78C850; --type-electric: #F8D030; --type-ice: #98D8D8;
            --type-fighting: #C03028; --type-poison: #A040A0; --type-ground: #E0C068;
            --type-flying: #A890F0; --type-psychic: #F85888; --type-bug: #A8B820;
            --type-rock: #B8A038; --type-ghost: #705898; --type-dragon: #7038F8;
            --type-dark: #705848; --type-steel: #B8B8D0; --type-fairy: #EE99AC;
        }

        * { font-family: 'DM Sans', sans-serif; box-sizing: border-box; }
        .font-display { font-family: 'Bebas Neue', sans-serif; }

        body {
            background: #0f0f13;
            background-image: radial-gradient(ellipse at 20% 50%, rgba(220,38,38,0.08) 0%, transparent 60%),
                              radial-gradient(ellipse at 80% 20%, rgba(59,130,246,0.06) 0%, transparent 50%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            width: 360px;
            background: #1a1a24;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 40px 80px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.05);
            position: relative;
        }

        .hero {
            position: relative;
            padding: 28px 28px 0;
            background: linear-gradient(160deg, #1f1f2e 0%, #16161f 100%);
            overflow: hidden;
        }

        .hero-number {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 80px;
            line-height: 1;
            color: rgba(255,255,255,0.04);
            position: absolute;
            top: 10px; right: 16px;
            user-select: none;
        }

        .hero-id {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            color: rgba(255,255,255,0.35);
            text-transform: uppercase;
        }

        .hero-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 38px;
            color: #fff;
            line-height: 1;
            letter-spacing: 1px;
            margin: 2px 0 10px;
            text-transform: capitalize;
        }

        .type-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #fff;
            margin-right: 4px;
        }

        .pokemon-img-wrap {
            position: relative;
            height: 160px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            margin-top: 8px;
        }

        .pokemon-img-shadow {
            position: absolute;
            bottom: 8px;
            width: 120px;
            height: 16px;
            background: radial-gradient(ellipse, rgba(0,0,0,0.5) 0%, transparent 70%);
            border-radius: 50%;
        }

        .pokemon-img {
            position: relative;
            height: 155px;
            width: 155px;
            object-fit: contain;
            /* CORREÇÃO DO ERRO: drop-shadow não é propriedade, é filtro */
            filter: drop-shadow(0 20px 40px rgba(0,0,0,0.5)) drop-shadow(0 8px 24px rgba(0,0,0,0.4));
            z-index: 1;
        }

        .tabs-header {
            display: flex;
            background: #111118;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .tab-btn {
            flex: 1;
            padding: 12px 4px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
            background: transparent;
            border: none;
            cursor: pointer;
            position: relative;
            transition: color 0.2s;
        }

        .tab-btn.active { color: #fff; }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: 0; left: 16px; right: 16px;
            height: 2px;
            background: #ef4444;
            border-radius: 2px 2px 0 0;
        }

        .tab-content { display: none; padding: 20px 24px; min-height: 200px; }
        .tab-content.active { display: block; }

        .stat-row { margin-bottom: 10px; }
        .stat-label { font-size: 10px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: rgba(255,255,255,0.35); }
        .stat-value { font-size: 12px; font-weight: 700; color: #fff; }
        .stat-bar-bg { width: 100%; background: rgba(255,255,255,0.08); border-radius: 4px; height: 4px; margin-top: 4px; }
        .stat-bar-fill { height: 4px; border-radius: 4px; transition: width 0.5s ease; }

        .info-pill {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 10px 14px;
            text-align: center;
            flex: 1;
        }

        .info-pill-label { font-size: 9px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: rgba(255,255,255,0.3); }
        .info-pill-value { font-size: 15px; font-weight: 700; color: #fff; margin-top: 2px; }

        .move-tag {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            padding: 5px 10px;
            font-size: 10px;
            font-weight: 600;
            color: rgba(255,255,255,0.75);
            text-transform: capitalize;
        }

        .variant-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px;
            padding: 10px 6px 8px;
            text-align: center;
            transition: all 0.2s;
        }
        .variant-card img { width: 52px; height: 52px; object-fit: contain; filter: grayscale(0.3); margin: 0 auto; }
        .variant-label { font-size: 9px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; color: rgba(255,255,255,0.4); margin-top: 5px; }

        .mega-badge {
            display: inline-block;
            font-size: 8px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            background: linear-gradient(135deg, #f59e0b, #ef4444);
            color: #fff;
            padding: 2px 6px;
            border-radius: 4px;
            margin-bottom: 4px;
        }

        .section-label {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.2);
            margin-bottom: 10px;
        }

        .btn-catch {
            margin: 0 24px 24px;
            background: #ef4444;
            color: #fff;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 13px;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            width: calc(100% - 48px);
            transition: all 0.15s;
        }
        .btn-catch:hover { background: #dc2626; transform: translateY(-1px); box-shadow: 0 8px 20px rgba(239,68,68,0.35); }
    </style>
</head>
<body>

<div class="card">
    <div class="hero">
        <span class="hero-number">#{{ str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT) }}</span>
        <div class="hero-id">Pokédex #{{ str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT) }}</div>
        <div class="hero-name">{{ $pokemon['name'] }}</div>

        <div style="margin-bottom: 12px;">
            <?php
                $typeColors = [
                    'normal'=>'#7C7C6A','fire'=>'#c2622b','water'=>'#3b62cc',
                    'grass'=>'#4a8c2a','electric'=>'#b8980c','ice'=>'#4a9c9c',
                    'fighting'=>'#8c1818','poison'=>'#7a2a7a','ground'=>'#a87c28',
                    'flying'=>'#6858cc','psychic'=>'#cc2860','bug'=>'#6c7c10',
                    'rock'=>'#887020','ghost'=>'#483870','dragon'=>'#4818c8',
                    'dark'=>'#483428','steel'=>'#787890','fairy'=>'#c8607a',
                ];
            ?>
            @foreach($pokemon['types'] as $tipo)
                <span class="type-badge" style="background-color: <?php echo $typeColors[$tipo['type']['name']] ?? '#555' ?>;">
                    {{ $tipo['type']['name'] }}
                </span>
            @endforeach
        </div>

        <div class="pokemon-img-wrap">
            <div class="pokemon-img-shadow"></div>
            <img class="pokemon-img" 
                 src="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] }}" 
                 alt="{{ $pokemon['name'] }}">
        </div>
    </div>

    <div class="tabs-header">
        <button class="tab-btn active" onclick="switchTab('stats', this)">Stats</button>
        <button class="tab-btn" onclick="switchTab('moves', this)">Moves</button>
        <button class="tab-btn" onclick="switchTab('forms', this)">Formas</button>
    </div>

    <div id="tab-stats" class="tab-content active">
        <div style="display:flex; gap:10px; margin-bottom:18px;">
            <div class="info-pill">
                <div class="info-pill-label">Altura</div>
                <div class="info-pill-value">{{ $pokemon['height']/10 }}m</div>
            </div>
            <div class="info-pill">
                <div class="info-pill-label">Peso</div>
                <div class="info-pill-value">{{ $pokemon['weight']/10 }}kg</div>
            </div>
        </div>

        <?php
            $barColors = [
                'hp'=>'#22c55e','attack'=>'#ef4444','defense'=>'#3b82f6',
                'special-attack'=>'#a855f7','special-defense'=>'#06b6d4','speed'=>'#f59e0b'
            ];
        ?>

        @foreach($pokemon['stats'] as $stat)
            <?php
                $pct = min(100, round(($stat['base_stat'] / 255) * 100));
                $color = $barColors[$stat['stat']['name']] ?? '#ef4444';
            ?>
            <div class="stat-row">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span class="stat-label">{{ str_replace('special-', 'Sp. ', ucwords(str_replace('-', ' ', $stat['stat']['name']))) }}</span>
                    <span class="stat-value">{{ $stat['base_stat'] }}</span>
                </div>
                <div class="stat-bar-bg">
                    <div class="stat-bar-fill" style="width: <?php echo $pct ?>%; background-color: {{ $color }};"></div>
                </div>
            </div>
        @endforeach
    </div>

    <div id="tab-moves" class="tab-content">
        <div class="section-label">Golpes (Nv. 1)</div>
        <div style="display:flex; flex-wrap:wrap; gap:8px;">
            <?php $count = 0; ?>
            @foreach($pokemon['moves'] as $move)
                @foreach($move['version_group_details'] as $details)
                    @if($details['level_learned_at'] == 1 && $details['move_learn_method']['name'] == 'level-up' && $count < 8)
                        <span class="move-tag">{{ str_replace('-', ' ', $move['move']['name']) }}</span>
                        <?php $count++; ?>
                        @break
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>

    <div id="tab-forms" class="tab-content">
        <?php
            $megas = array_filter($species['varieties'], fn($v) => str_contains($v['pokemon']['name'], '-mega'));
            $gigantamax = array_filter($species['varieties'], fn($v) => str_contains($v['pokemon']['name'], '-gmax'));
            $others = array_filter($species['varieties'], fn($v) => 
                !str_contains($v['pokemon']['name'], '-mega') && 
                !str_contains($v['pokemon']['name'], '-gmax') && 
                $v['pokemon']['name'] !== $pokemon['name']
            );
        ?>

        @if(count($megas) > 0)
            <div class="section-label" style="color: #fb923c;">⚡ Mega Evoluções</div>
            <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:8px; margin-bottom:18px;">
                @foreach($megas as $variety)
                    <?php
                        $parts = explode('/', rtrim($variety['pokemon']['url'], '/'));
                        $vid = end($parts);
                        $imgUrl = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$vid}.png";
                        $label = strtoupper(str_replace([$pokemon['name'] . '-', '-'], ['', ' '], $variety['pokemon']['name']));
                    ?>
                    <div class="variant-card">
                        <div class="mega-badge">MEGA</div>
                        <img src="{{ $imgUrl }}" alt="{{ $label }}">
                        <div class="variant-label">{{ $label }}</div>
                    </div>
                @endforeach
            </div>
        @endif

        @if(count($others) > 0)
            <div class="section-label">Outras Formas</div>
            <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:8px;">
                @foreach($others as $variety)
                    <?php
                        $parts = explode('/', rtrim($variety['pokemon']['url'], '/'));
                        $vid = end($parts);
                        $imgUrl = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$vid}.png";
                        $pName = $pokemon['name'];
                        $label = strtoupper(str_replace([$pName . '-', '-'], ['', ' '], $variety['pokemon']['name'])) ?: 'BASE';
                    ?>
                    <div class="variant-card">
                        <img src="{{ $imgUrl }}" alt="{{ $label }}">
                        <div class="variant-label">{{ $label }}</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <button class="btn-catch" onclick="window.location.reload()">
        → Próximo Pokémon
    </button>
</div>

<script>
function switchTab(name, btn) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    btn.classList.add('active');
}
</script>

</body>
</html>