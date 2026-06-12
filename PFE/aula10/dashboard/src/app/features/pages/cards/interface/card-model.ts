export interface ICardModel {
    title: string,
    color : TColorsBS
}

type TColorsBS = 'primary' | 'secondary' | 'success' | 'danger' | 'warning' | 'info' | 'light' | 'dark'