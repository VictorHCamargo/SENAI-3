import { useTheme } from "../../../theme/hook/theme.hook";
import { useEvents } from "../../hook/event.hook";

export function EventHeader() {
    const { clearTimeline: limparCronograma } = useEvents();
    const { theme, toggleTheme } = useTheme();

    return (
        <header>
            <h1>EventPulse</h1>
            <p>Gestão de Eventos Acadêmicos</p>
            <div className="header-actions">
                <button onClick={toggleTheme} className="theme-btn">
                    {theme === 'light' ? '🌙 Modo Dark' : '☀️ Modo Light'}
                </button>
                <button onClick={limparCronograma} className="clear-btn">
                    🗑️ Limpar Cronograma
                </button>
            </div>
        </header>
    );
}
