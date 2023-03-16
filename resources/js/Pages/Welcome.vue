<script setup>
import { ref } from "vue";
// import fsp from "../fsp";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
// const taskStore = useTasksStore();
const tasks = ref([]);
const title = ref("");

async function addTask() {
    const response = await fetch("/api/tasks", {
        method: "POST",
        body: JSON.stringify({ title: title.value }),
        headers: {
            "Content-Type": "application/json",
        },
    });
    const createdTask = await response.json();
    tasks.value.push(createdTask);
}
async function toggleCompleted(id, index, completed) {
    console.log("toggleCompleted");
    tasks.value[index].completed = !completed;
    await fetch(`/api/tasks/${id}/toggleComplete`);
}
async function fetchTasks() {
    const response = await fetch("/api/tasks");
    tasks.value = await response.json();

    console.log("fetchTasks", { tasks });
}
async function deleteTask(id) {
    tasks.value = tasks.value.filter((task) => task.id !== id);
    fetch(`/api/tasks/${id}`, {
        method: "DELETE"
    });
}
fetchTasks();
</script>

<template>
    <div class="container">
        <h1>Tasks {{ tasks.length }}</h1>
        <div class="input-group">
            <input
                type="text"
                v-model="title"
                class="form-control"
                placeholder="New task"
            />
            <div class="input-group-append">
                <button
                    type="button"
                    @click="addTask"
                    class="btn btn-outline-primary"
                >
                    + Add
                </button>
            </div>
        </div>
        <ul>
            <li v-for="(task, index) in tasks">
                <div class="alert alert-success task" role="alert">
                    <span
                        :class="{ completed: task.completed }"
                        @click="toggleCompleted(task.id, index, task.completed)"
                        >{{ task.title
                        }}{{ JSON.stringify(tasks.completed) }}</span
                    >
                    <button
                        type="button"
                        @click="deleteTask(task.id)"
                        class="btn btn-outline-danger float-right"
                    >
                        x
                    </button>
                </div>
            </li>
        </ul>
    </div>
</template>

<style>
.completed {
    text-decoration: line-through;
}
.task {
    height: 65px;
}
</style>
