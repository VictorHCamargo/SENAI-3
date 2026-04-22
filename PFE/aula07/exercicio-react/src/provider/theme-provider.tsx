import { useEffect, useState } from "react"
import { ThemeContext } from "../context/theme-context"

export function ThemeProvider({ children }: { children: React.ReactNode }) {
    const [dark, setDark] = useState(false)

    useEffect(() => {
        document.documentElement.setAttribute('data-theme', dark ? 'dark' : 'light')
    }, [dark])

    return (
        <ThemeContext.Provider value={{ dark, setDark }}>
            {children}
        </ThemeContext.Provider>
    )
}