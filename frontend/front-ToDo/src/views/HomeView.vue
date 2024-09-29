<template>

  <div class="container-fluid">
    <FormCadastroComponent 
      @atualizar-tarefas="fetchTarefas" 
      :tarefaParaEditar="tarefaParaEditar" 
    />
      <TabelaComponent 
      :listaTarefas="listaTarefas" 
      @editar-tarefa="prepararEdicao" 
      @atualizar-tarefas="fetchTarefas" 
    />
  </div>
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
    prepararEdicao(tarefa) {
      this.tarefaParaEditar = tarefa; 
    },
  },
};
</script>
