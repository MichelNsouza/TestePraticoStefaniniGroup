<template>
  <template v-if="alerta">
    <AlertComponent :type="tipoAlerta" :message="mensagem" />
  </template>

  <div class="container p-4 mt-5 bg-tabela shadow rounded">
    <div class="row table-responsive">
      <p class="h3 text-center text-white">Minhas Tarefas</p>

      <div class="container mt-5">
        <div class="row mb-3">
          <div class="col-md-6">
            <input type="text" class="form-control" v-model="termoBusca" placeholder="Buscar tarefas por título" />
          </div>
        </div>
      </div>

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
          <tr v-for="tarefa in tarefasFiltradas" :key="tarefa.id"
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
    <template v-if="tarefasFiltradas.length === 0">
      <AlertComponent :type="'primary'" :message="'Cadastre uma tarefa!'" />
    </template>
  </div>
</template>

<script>
import AlertComponent from '@/components/AlertComponent.vue';
import { deleteTarefa, getTarefaByTitulo } from '@/services/axios';

export default {
  emits: ['editarTarefa', 'atualizarTarefas'],
  props: {
    listaTarefas: {
      type: Array,
      default: () => []
    },
    alerta: {
      type: String,
      default: '' // ou algum valor padrão apropriado
    }
  },
  components: {
    AlertComponent,
  },
  data() {
    return {
      termoBusca: '',
      tarefas: this.listaTarefas, // Inicializa tarefas com a prop recebida
    };
  },
  watch: {
    termoBusca(newVal) {
      this.buscarTarefas(); // Chama a busca toda vez que o termo mudar
    },
    listaTarefas: {
      immediate: true,
      handler(newVal) {
        this.tarefas = newVal; // Atualiza a lista de tarefas quando a prop mudar
      },
    },
  },
  methods: {
    async buscarTarefas() {
      // Se o campo de busca estiver vazio, retorna a lista completa
      if (!this.termoBusca) {
        this.tarefas = this.listaTarefas;
        return;
      }

      try {
        const response = await getTarefaByTitulo(this.termoBusca);
        this.tarefas = response.data;
      } catch (error) {
        console.error('Erro ao buscar tarefas:', error);
        this.tarefas = [];
      }
    },

    async excluirTarefa(tarefa) {
      try {
        await deleteTarefa(tarefa.id);
        this.buscarTarefas();
      } catch (error) {
        console.error('Erro ao excluir a tarefa:', error);
      }
    },

    editarTarefa(tarefa) {
      this.$emit('editar-tarefa', tarefa);
    },
  },
  computed: {
    tarefasFiltradas() {
      if (!this.termoBusca) {
        return this.tarefas; // Exibe todas as tarefas se não houver termo de busca
      }
      return this.tarefas.filter(tarefa =>
        tarefa.titulo.toLowerCase().includes(this.termoBusca.toLowerCase())
      );
    },
  },
};
</script>

<style>
.bg-tabela {
  background-color: #222f77;
}
</style>
