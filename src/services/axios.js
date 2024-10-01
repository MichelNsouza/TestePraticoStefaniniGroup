import axios from 'axios';

//
const api = axios.create({
    baseURL: 'http://127.0.0.1:8000/api',
  });
  
// Obter todas as tarefas
export const getAllTarefas = () => api.get('/tarefas');

// Obter uma tarefa por ID
export const getTarefaById = (id) => api.get(`/tarefas/${id}`);

// Obter uma tarefa por titulo
export const getTarefaByTitulo = (titulo) => api.get(`/tarefas?titulo=${titulo}`);

// Criar uma nova tarefa
export const createTarefa = (formData) => api.post('/tarefas', formData);

// Atualizar uma tarefa existente
export const updateTarefa = (id, formData) => api.put(`/tarefas/${id}`, formData);

// Excluir uma tarefa
export const deleteTarefa = (id) => api.delete(`/tarefas/${id}`);

export default api;