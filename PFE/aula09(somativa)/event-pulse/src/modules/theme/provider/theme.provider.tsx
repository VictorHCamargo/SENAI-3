import { ReactNode, useEffect, useState } from "react";
import { TTheme } from "../interfaces/theme-config";
import { ThemeContext } from "../context/theme.context";

export function ThemeProvider({ children }: { children: ReactNode }) {
    const LOCALSTORAGE_KEY = '@eventpulse_theme';
    const [theme, setTheme] = useState<TTheme>(() => {
        return (localStorage.getItem(LOCALSTORAGE_KEY) as TTheme) || 'light';
    });

    useEffect(() => {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem(LOCALSTORAGE_KEY, theme);
    }, [theme]);

    function toggleTheme() {
        setTheme(prev => prev === 'light' ? 'dark' : 'light');
    }

    return (
        <ThemeContext.Provider value={{ theme, toggleTheme }}>
            {children}
        </ThemeContext.Provider>
    );
}
