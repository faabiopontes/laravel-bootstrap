export const useTasksStore = defineStore("tasks", {
    state: () => ({ tasks: [] }),
    actions: {
        addTask(title) {
            this.tasks.push({
                title: title,
            });
        },
    },
});
