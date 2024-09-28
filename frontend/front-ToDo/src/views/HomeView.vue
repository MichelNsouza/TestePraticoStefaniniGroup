<template>
  <main>
    <FormCadastroComponent 
      @atualizar-tarefas="fetchTarefas" 
      :tarefaParaEditar="tarefaParaEditar" 
    />
    <TabelaComponent 
      :listaTarefas="listaTarefas" 
      @editar-tarefa="prepararEdicao" 
    />
  </main>
</template>

<script>
import TabelaComponent from '@/components/TabelaComponent.vue';
import FormCadastroComponent from '@/components/FormCadastroComponent.vue';
import { getAllTarefas } from '@/services/axios';

export default {
  components: {
    TabelaComponent,
    FormCadastroComponent,
  },
  data() {
    return {
      tarefaParaEditar: null,
      listaTarefas: [], // Armazenar a lista de tarefas
    };
  },
  created() {
    this.fetchTarefas();
  },
  methods: {
    async fetchTarefas() {
      try {
        const response = await getAllTarefas();
        this.listaTarefas = response.data.tarefas; // Atualizar a lista de tarefas
      } catch (error) {
        console.error('Erro ao buscar tarefas:', error);
      }
    },
    prepararEdicao(tarefa) {
      this.tarefaParaEditar = tarefa; // Passa a tarefa que você deseja editar
    },
  },
};
</script>
