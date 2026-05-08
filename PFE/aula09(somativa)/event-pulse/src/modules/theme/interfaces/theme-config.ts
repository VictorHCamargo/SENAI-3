export type TTheme = 'light' | 'dark';

export interface IThemeConfig {
    theme: TTheme;
    toggleTheme: () => void;
}
