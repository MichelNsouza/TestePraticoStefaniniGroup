<script>

import { getAllTarefas } from '@/services/axios';

export default {

  components: {

  },
  data() {
    return {
      listaTarefas: [],
    };
  },
  created() {
    this.fetchTarefas();
  },
  methods: {
    async fetchTarefas() {
      try {
        const response = await getAllTarefas();
        this.listaTarefas = response.data.tarefas;
      } catch (error) {
        console.error('Erro ao buscar tarefas:', error);
      }
    },
  }
}
</script>

<template>
  <main>

    <div class="container-fluid">
      <div class="row">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Titulo</th>
              <th scope="col">Descrição</th>
              <th scope="col">Status</th>
              <th scope="col">Criado em</th>
              <th scope="col">editar</th>
              <th scope="col">Excluir</th>
            </tr>
          </thead>
          <tbody>

            <template v-for="tarefa in listaTarefas" :key="tarefa.id">

              <tr>
                <th scope="row">{{ tarefa.id }}</th>
                <td>{{ tarefa.titulo }}</td>
                <td>{{ tarefa.descricao }}</td>
                <td>{{ tarefa.status }}</td>
                <td>{{ tarefa.created_at }}</td>
                <td>E</td>
                <td>X</td>
              </tr>
            </template>

          </tbody>
        </table>
      </div>
    </div>
  </main>
</template>
