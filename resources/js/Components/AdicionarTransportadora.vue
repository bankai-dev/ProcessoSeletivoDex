<template>
  <div>
    <button
      @click="abrirModal"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
    >
      Adicionar Transportadora
    </button>
    <div v-show="modalAberto" class="modal">
      <span @click="fecharModal" class="modal-fechar absolute top-0 right-0 p-4 cursor-pointer">&times;</span>
      <div class="p-8">
        <h2 class="text-lg font-bold mb-4">Adicionar Transportadora</h2>
        <form  @submit="adicionarTransportadora">
          <div class="mb-4">
            <label for="nome" class="block text-gray-700">Nome:</label>
            <input
              type="text"
              id="nome"
              v-model="novaTransportadora.nome"
              required
              class="w-full p-2 border rounded-md"
            />
          </div>
          <div class="mb-4">
            <label for="endereco" class="block text-gray-700">Endereço:</label>
            <input
              type="text"
              id="endereco"
              v-model="novaTransportadora.endereco"
              required
              class="w-full p-2 border rounded-md"
            />
          </div>
          <div class="mb-4">
            <label for="bairro" class="block text-gray-700">Bairro:</label>
            <input
              type="text"
              id="bairro"
              v-model="novaTransportadora.bairro"
              required
              class="w-full p-2 border rounded-md"
            />
          </div>
          <div class="mb-4">
            <label for="cidade" class="block text-gray-700">Cidade:</label>
            <input
              type="text"
              id="cidade"
              v-model="novaTransportadora.cidade"
              required
              class="w-full p-2 border rounded-md"
            />
          </div>
          <div class="mb-4">
            <label for="uf" class="block text-gray-700">UF:</label>
            <input
              type="text"
              id="uf"
              v-model="novaTransportadora.uf"
              required
              class="w-full p-2 border rounded-md"
            />
          </div>
          <div class="mb-4">
            <label for="cep" class="block text-gray-700">CEP:</label>
            <input
              type="text"
              id="cep"
              v-model="novaTransportadora.cep"
              required
              class="w-full p-2 border rounded-md"
            />
          </div>
          <div class="mb-4">
            <label for="limite_credito" class="block text-gray-700">Limite de Crédito:</label>
            <input
              type="text"
              id="limite_credito"
              v-model="novaTransportadora.limite_credito"
              required
              class="w-full p-2 border rounded-md"
            />
          </div>
          <div class="mb-4">
            <label for="data_analise_credito" class="block text-gray-700">Data de Análise de Crédito:</label>
            <input
              type="text"
              id="data_analise_credito"
              v-model="novaTransportadora.data_analise_credito"
              required
              class="w-full p-2 border rounded-md"
              placeholder="YYYY-MM-DD"
            />
          </div>
          <button
            type="submit"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
          >
            Salvar
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";

const transportadoras = ref([]);
const formularioVisivel = ref(true);
const modalAberto = ref(false);
const novaTransportadora = ref({
  nome: "",
  endereco: "",
  bairro: "",
  cidade: "",
  uf: "",
  cep: "",
  limite_credito: "",
  data_analise_credito: "",
});

onMounted(async () => {
  carregarTransportadoras();
});


async function carregarTransportadoras() {
  try {
    const response = await axios.get("/api/transportadoras");
    transportadoras.value = response.data;
  } catch (error) {
    console.error("Erro ao carregar transportadoras:", error);
  }
}

function abrirModal() {
  modalAberto.value = true;
}

function fecharModal() {
  modalAberto.value = false;
}

async function adicionarTransportadora() {
  // event.preventDefault();
  try {
    await axios.post("/api/transportadoras", novaTransportadora.value);
    await buscarEnderecoPorCEP();
    novaTransportadora.value = {
      nome: "",
      endereco: "",
      bairro: "",
      cidade: "",
      uf: "",
      cep: "",
      limite_credito: "",
      data_analise_credito: "",
    };
    carregarTransportadoras();
    modalAberto.value = false;
  } catch (error) {
    console.error("Erro ao adicionar transportadora:", error);
  }
}

const buscarEnderecoPorCEP = async () => {
  try {
    const response = await axios.get(`https://viacep.com.br/ws/${novaTransportadora.value.cep}/json/`);
    if (response.data) {
      const { localidade, bairro, uf } = response.data;
      transportadoraEditada.value.cidade = localidade;
      transportadoraEditada.value.bairro = bairro;
      transportadoraEditada.value.uf = uf;
    } else {
      console.error("Endereço não encontrado para o CEP informado.");
    }
  } catch (error) {
    console.error("Erro ao buscar endereço por CEP:", error);
  }
};
</script>

<style scoped>

.modal {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 90%;
  max-width: 600px;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

.modal-fechar {
  font-size: 24px;
}
</style>