<template>
  <template v-if="alerta">
    <AlertComponent :type="tipoAlerta" :message="mensagem" />
  </template>

  <div class="container mt-5 p-5 bg-tabela bg-form shadow rounded">
    <div class="row table-responsive">
      <p class="h3 text-white text-center">Minhas Tarefas</p>

      <div class="row mb-3">
        <div class="col-md-3">
          <input type="text" class="form-control" v-model="termoBusca" placeholder="Buscar tarefas por título"
            @input="buscarTarefas" />
        </div>
      </div>

      <table class="table table-hover table-secondary text-center">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Título</th>
            <th scope="col">Descrição</th>
            <th scope="col">Status</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          <!-- Tabela de tarefas filtradas -->
          <tr v-for="tarefa in tarefas" :key="tarefa.id"
            :class="tarefa.status === 'concluído' ? 'text-decoration-line-through' : ''">
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

    <!-- Exibe uma mensagem caso não haja tarefas filtradas -->
    <template v-if="tarefas.length === 0">
      <AlertComponent :type="'primary'" :message="'Nenhuma tarefa encontrada!'" />
    </template>
  </div>
</template>

<script>
import AlertComponent from '@/components/AlertComponent.vue';
import { deleteTarefa, getTarefaByTitulo, getAllTarefas } from '@/services/axios'; // Certifique-se de que essa função exista no seu serviço

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
  data() {
    return {
      termoBusca: '', // Termo da busca
      tarefas: [], // Armazena as tarefas buscadas
    };
  },
  mounted() {
    this.carregarTarefas(); // Carrega todas as tarefas ao montar o componente
  },
  methods: {
    async carregarTarefas() {
      try {
        const response = await getAllTarefas(); // Busca todas as tarefas
        this.tarefas = response.data; // Supondo que a resposta seja um array de tarefas
      } catch (error) {
        console.error('Erro ao carregar tarefas:', error);
        this.tarefas = []; // Limpa as tarefas em caso de erro
      }
    },
    async buscarTarefas() {
      if (!this.termoBusca) {
        return this.carregarTarefas(); // Se o termo de busca estiver vazio, carrega todas as tarefas
      }

      try {
        const response = await getTarefaByTitulo(this.termoBusca);
        this.tarefas = response.data; // Supondo que a resposta seja um array de tarefas
      } catch (error) {
        console.error('Erro ao buscar tarefas:', error);
        this.tarefas = []; // Limpa as tarefas em caso de erro
      }
    },
    async excluirTarefa(tarefa) {
      try {
        await deleteTarefa(tarefa.id);
        this.carregarTarefas(); // Atualiza a lista de tarefas após exclusão
      } catch (error) {
        console.error('Erro ao excluir a tarefa:', error);
      }
    },
    editarTarefa(tarefa) {
      this.$emit('editar-tarefa', tarefa);
    },
  },
};
</script>
