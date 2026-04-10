import { useTheme } from "../../../hook/use-theme";


export function ThemeToggle() {
    const { dark, setDark } = useTheme()
    return (
        <button onClick={function() { setDark(!dark) }} style={{ marginTop: '10px'
        }}>
        Mudar para modo {dark ? 'Claro' : 'Escuro'}
        </button>
    );
}