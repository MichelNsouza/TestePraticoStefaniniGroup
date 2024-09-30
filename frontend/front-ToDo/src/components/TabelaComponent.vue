<template>

  <template v-if="alerta">
    <AlertComponent :type="tipoAlerta" :message="mensagem" />
  </template>

  <div class="container p-4 mt-5 bg-tabela shadow rounded" >
    <div class="row table-responsive">
      <p class="h3 text-center text-white">Minhas Tarefas</p>
      <table class="table table-hover table-secondary text-center">
        <thead class="">
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Título</th>
            <th scope="col">Descrição</th>
            <th scope="col">Status</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="tarefa in listaTarefas" :key="tarefa.id" :class="tarefa.status==='concluído'? 'text-decoration-line-through':''">
            <td>{{ tarefa.id }}</td>
            <td>{{ tarefa.titulo }}</td>
            <td>{{ tarefa.descricao }}</td>
            <td>{{ tarefa.status }}</td>
            <td scope="col">
              <button class="btn bg-warning bg-opacity-75 me-2" @click="editarTarefa(tarefa)">Editar</button>
                
              <button class="btn bg-danger bg-opacity-75" @click="excluirTarefa(tarefa)">Excluir</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <template v-if="listaTarefas.length === 0" >
    <AlertComponent :type="primary" :message="'Cadastre uma tarefa!'" />
  </template>
  </div>
  
</template>

<script>
import AlertComponent from '@/components/AlertComponent.vue';
import { deleteTarefa } from '@/services/axios';

export default {
  props: {
    listaTarefas: {
      type: Array,
      required: true, 
    },
  },
  components: {
    AlertComponent,
  },
  methods: {
    async excluirTarefa(tarefa) {
      try {
        await deleteTarefa(tarefa.id);
        this.$emit('atualizar-tarefas'); 
      } catch (error) {
        console.error('Erro ao excluir a tarefa:', error);
      }
    },

    editarTarefa(tarefa) {
      this.$emit('editar-tarefa', tarefa); 
    },
    formatarDataHora(dataApi) {
      const data = new Date(dataApi);
      const dia = String(data.getDate()).padStart(2, '0');
      const mes = String(data.getMonth() + 1).padStart(2, '0');
      const ano = data.getFullYear();
      const horas = String(data.getHours()).padStart(2, '0');
      const minutos = String(data.getMinutes()).padStart(2, '0');

      return `${dia}/${mes}/${ano} ${horas}:${minutos}`;
    }

  },
};
</script>

<style>
.bg-tabela{
 background-color:#222f77; 
}
</style>