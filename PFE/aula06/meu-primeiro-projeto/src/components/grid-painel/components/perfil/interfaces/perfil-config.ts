type RoleConfig = "Aluno" | "Professor";

export interface IPerfilConfig {
    name : string,
    role : RoleConfig,
    describe : string
}