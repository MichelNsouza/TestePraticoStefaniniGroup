<style>
.bg-form{
 background-color:#222f77; 
}

</style>

<template>

    <template v-if="alerta">
        <AlertComponent class="mx-4 text-center mx-auto w-50" :type="tipoAlerta" :message="mensagem" />
    </template>

    <div class="container p-3 mt-4 bg-tabela bg-form shadow rounded d-flex row justify-content-center text-center mx-auto d-sm-block ">
        <p class="h2 text-white">{{ tarefaParaEditar ? 'Editar Tarefa' : 'Criar Tarefa' }}</p>
        <form class="row pb-4 g-3 align-items-center justify-content-center" @submit.prevent="enviarTarefa">
    <div class="col-md-3 col-lg-2">
        <input class="form-control" v-model="tarefa.titulo" placeholder="Título" required />
    </div>
    <div class="col-md-3 col-lg-3">
        <input class="form-control" v-model="tarefa.descricao" placeholder="Descrição" required />
    </div>
    <div class="col-md-3 col-lg-2">
        <select class="form-select" v-model="tarefa.status">
            <option value="não iniciado">Não Iniciado</option>
            <option value="em andamento">Em Andamento</option>
            <option value="concluído">Concluído</option>
        </select>
    </div>
    <div class="col-md-3 col-lg-2">
        <button class="btn bg-success text-white w-100" type="submit">
            {{ tarefaParaEditar ? 'Salvar Alterações' : 'Adicionar Tarefa' }}
        </button>
    </div>
</form>

    </div>
</template>

<script>
import AlertComponent from '@/components/AlertComponent.vue';
import { createTarefa, updateTarefa } from '@/services/axios';

export default {
    props: {
        tarefaParaEditar: {
            type: Object,
            default: null,
        },
    },
    components: {
        AlertComponent,
    },
    data() {
        return {
            alerta: false,
            mensagem: '',
            tipoAlerta: '',
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
                    this.tarefa = { ...newValue }; 
                } else {
                    this.resetForm(); 
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
        validacaoTitulo() {
            if (this.tarefa.titulo.length < 3) {
                this.alerta = true;
                this.mensagem = "O título não pode ser menor que 3 caracteres";
                this.tipoAlerta = 'warning';
                return true;
            } else if (this.tarefa.titulo.length > 300) {
                this.alerta = true;
                this.mensagem = "O título não pode ter mais que 50 caracteres";
                this.tipoAlerta = 'warning';
                return true;
            }
        },
        validacaoDescricao() {
            if (this.tarefa.descricao.length < 3) {
                this.alerta = true;
                this.mensagem = "A descrição não pode ser menor que 3 caracteres";
                this.tipoAlerta = 'warning';
                return true;
            } else if (this.tarefa.descricao.length > 300) {
                this.alerta = true;
                this.mensagem = "A descrição não pode ter mais que 50 caracteres";
                return true;
            }
        },
        async enviarTarefa() {
            try {
                if (!this.validacaoTitulo() && !this.validacaoDescricao() ) {
                    if (this.tarefaParaEditar) {
                        await updateTarefa(this.tarefaParaEditar.id, this.tarefa);
                        console.log('Tarefa atualizada com sucesso');
                    } else {
                        await createTarefa(this.tarefa);
                        console.log('Tarefa criada com sucesso');
                    }
                }
                this.$emit('atualizar-tarefas');

                this.resetForm();
            } catch (error) {
                console.error('Erro ao salvar a tarefa:', error);
            }
        },
    },
};
</script>