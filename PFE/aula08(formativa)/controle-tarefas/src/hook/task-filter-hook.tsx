import { useContext } from "react";
import { TaskFilterContext } from "../context/task-filter-context";

export function useTaskFilter() {
  const context = useContext(TaskFilterContext);
  if (!context) throw new Error("useTaskFilter deve ser usado dentro do TaskFilterProvider");
  return context;
}