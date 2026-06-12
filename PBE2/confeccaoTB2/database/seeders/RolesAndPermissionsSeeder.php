<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Resetar o cache de permissões do Spatie
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Definir os módulos e as permissões básicas
        $modulos = ['clientes', 'pedidos', 'insumos', 'produtos', 'fornecedores', 'usuarios', 'roles'];
        $acoes = ['ver', 'criar', 'editar', 'deletar'];

        foreach ($modulos as $modulo) {
            foreach ($acoes as $acao) {
                Permission::findOrCreate("{$modulo}.{$acao}");
            }
        }

        // 2. Criar os Perfis (Roles) e atribuir as permissões
        
        // Admin: Pode tudo
        $adminRole = Role::findOrCreate('Admin');
        $adminRole->givePermissionTo(Permission::all());

        // Gerente: Pode ver e gerenciar quase tudo, exceto deletar coisas críticas
        $gerenteRole = Role::findOrCreate('Gerente');
        $gerenteRole->givePermissionTo(Permission::all());
        $gerenteRole->revokePermissionTo(['roles.deletar', 'usuarios.deletar']);

        // Logística: Foco em pedidos e fornecedores
        $logisticaRole = Role::findOrCreate('Logistica');
        $logisticaRole->givePermissionTo([
            'pedidos.ver', 'pedidos.criar', 'pedidos.editar',
            'clientes.ver',
            'fornecedores.ver'
        ]);

        // Estoque: Foco em insumos e produtos
        $estoqueRole = Role::findOrCreate('Estoque');
        $estoqueRole->givePermissionTo([
            'insumos.ver', 'insumos.criar', 'insumos.editar',
            'produtos.ver', 'produtos.criar', 'produtos.editar',
            'pedidos.ver'
        ]);

        // 3. Criar Usuário Admin Padrão
        $adminUser = User::updateOrCreate(
            ['email' => 'admin@confeccao.com'],
            [
                'name' => 'Administrador Confecção',
                'password' => Hash::make('password'),
            ]
        );

        $adminUser->assignRole($adminRole);
    }
}