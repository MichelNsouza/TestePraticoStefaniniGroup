<template>
    <div>
      <h1>{{ tarefaParaEditar ? 'Editar Tarefa' : 'Criar Tarefa' }}</h1>
      <form @submit.prevent="enviarTarefa">
        <input v-model="tarefa.titulo" placeholder="Título" required />
        <input v-model="tarefa.descricao" placeholder="Descrição" required />
        <select v-model="tarefa.status">
          <option value="não iniciado">Não Iniciado</option>
          <option value="em andamento">Em Andamento</option>
          <option value="concluído">Concluído</option>
        </select>
        <button type="submit">{{ tarefaParaEditar ? 'Salvar Alterações' : 'Adicionar Tarefa' }}</button>
      </form>
    </div>
  </template>
  
  <script>
  import { createTarefa, updateTarefa } from '@/services/axios';
  
  export default {
    props: {
      tarefaParaEditar: {
        type: Object,
        default: null,
      },
    },
    data() {
      return {
        tarefa: {
          titulo: "",
          descricao: "",
          status: "não iniciado",
        },
      };
    },
    watch: {
      tarefaParaEditar: {
        immediate: true,
        handler(newValue) {
          if (newValue) {
            this.tarefa = { ...newValue }; // Preencher o formulário com a tarefa a ser editada
          } else {
            this.resetForm(); // Resetar o formulário
          }
        },
      },
    },
    methods: {
      resetForm() {
        this.tarefa = {
          titulo: "",
          descricao: "",
          status: "não iniciado",
        };
      },
      async enviarTarefa() {
        try {
          if (this.tarefaParaEditar) {
            await updateTarefa(this.tarefaParaEditar.id, this.tarefa);
            console.log('Tarefa atualizada com sucesso');
          } else {
            await createTarefa(this.tarefa);
            console.log('Tarefa criada com sucesso');
          }
  
          // Emitir evento para o componente pai para atualizar a lista de tarefas
          this.$emit('atualizar-tarefas');
  
          // Resetar o formulário após o envio
          this.resetForm();
        } catch (error) {
          console.error('Erro ao salvar a tarefa:', error);
        }
      },
    },
  };
  </script>
  