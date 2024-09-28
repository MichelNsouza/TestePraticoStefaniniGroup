<template>
    <div class="container-fluid">
      <div class="row">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Título</th>
              <th scope="col">Descrição</th>
              <th scope="col">Status</th>
              <th scope="col">Criado em</th>
              <th scope="col">Editar</th>
              <th scope="col">Excluir</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="tarefa in listaTarefas" :key="tarefa.id">
              <th scope="row">{{ tarefa.id }}</th>
              <td>{{ tarefa.titulo }}</td>
              <td>{{ tarefa.descricao }}</td>
              <td>{{ tarefa.status }}</td>
              <td>{{ tarefa.created_at }}</td>
              <th scope="col"><button @click="editarTarefa(tarefa)">Editar</button></th>
              <td>X</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      listaTarefas: {
        type: Array,
        required: true, // A lista de tarefas é obrigatória
      },
    },
    methods: {
      editarTarefa(tarefa) {
        this.$emit('editar-tarefa', tarefa); // Emitir evento para o componente pai
      },
    },
  };
  </script>
  