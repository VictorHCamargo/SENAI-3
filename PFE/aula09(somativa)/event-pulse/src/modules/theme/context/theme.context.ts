import { createContext } from "react";
import { IThemeConfig } from "../interfaces/theme-config";

export const ThemeContext = createContext<IThemeConfig | null>(null);
