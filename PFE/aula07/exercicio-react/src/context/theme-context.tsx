import { createContext } from "react"
import { IThemeContextConfig } from "./interface/theme-context-config"

export const ThemeContext = createContext<IThemeContextConfig>({} as IThemeContextConfig)