<template>
  <div>
    <table class="min-w-full divide-y divide-gray-200" style="width: 100%">
      <thead class="bg-gray-50">
        <tr>
          <th
            scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
          >
            Id
          </th>
          <th
            scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
          >
            Nome
          </th>
          <th
            scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
          >
            Endereço
          </th>
          <th
            scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
          >
            Bairro
          </th>
          <th
            scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
          >
            Cidade
          </th>
          <th
            scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
          >
            UF
          </th>
          <th
            scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
          >
            CEP
          </th>
          <th
            scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
          >
            Limite de Crédito
          </th>
          <th
            scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
          >
            Data de Análise de Crédito
          </th>
          <!-- <th scope="col" class="relative px-6 py-3">
            <span class="sr-only">Editar</span>
          </th>
          <th scope="col" class="relative px-6 py-3">
            <span class="sr-only">Excluir</span>
          </th> -->
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="transportadora in transportadoras" :key="transportadora.id">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">
              {{ transportadora.id }}
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">
              {{ transportadora.nome }}
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-500">
              {{ transportadora.endereco }}
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-500">{{ transportadora.bairro }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-500">{{ transportadora.cidade }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-500">{{ transportadora.uf }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-500">{{ transportadora.cep }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-500">
              {{ transportadora.limite_credito }}
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-500">
              {{ transportadora.data_analise_credito }}
            </div>
          </td>
          <td
            class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
          >
            <button
              @click="
                capturarTransportadora(transportadora.id);
                abrirModal();
              "
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
              Editar
            </button>
          </td>
          <td
            class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
          >
            <button
              @click="confirmDelete(transportadora.id)"
              class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
            >
              Excluir
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div>
    <div v-show="modalAberto" class="modal">
      <span
        @click="fecharModal"
        class="modal-fechar absolute top-0 right-0 p-4 cursor-pointer"
        >&times;</span
      >
      <div class="p-8">
        <h2 class="text-lg font-bold mb-4 text-left">Editar Transportadora</h2>
        <form>
          <div class="mb-4">
            <label for="nome" class="block text-gray-700 text-left"
              >Nome:</label
            >
            <input
              type="text"
              id="nome"
              v-model="transportadoraEditada.nome"
              class="w-full p-2 border rounded-md"
            />
          </div>
          <div class="mb-4">
            <label for="endereco" class="block text-gray-700 text-left"
              >Endereço:</label
            >
            <input
              type="text"
              id="endereco"
              v-model="transportadoraEditada.endereco"
              class="w-full p-2 border rounded-md"
            />
          </div>
          <div class="mb-4">
            <label for="bairro" class="block text-gray-700 text-left"
              >Bairro:</label
            >
            <input
              type="text"
              id="bairro"
              v-model="transportadoraEditada.bairro"
              class="w-full p-2 border rounded-md"
            />
          </div>
          <div class="mb-4">
            <label for="cidade" class="block text-gray-700 text-left"
              >Cidade:</label
            >
            <input
              type="text"
              id="cidade"
              v-model="transportadoraEditada.cidade"
              class="w-full p-2 border rounded-md"
            />
          </div>
          <div class="mb-4">
            <label for="uf" class="block text-gray-700 text-left">UF:</label>
            <input
              type="text"
              id="uf"
              v-model="transportadoraEditada.uf"
              class="w-full p-2 border rounded-md"
            />
          </div>
          <div class="mb-4">
            <label for="cep" class="block text-gray-700 text-left">Cep:</label>
            <input
              type="text"
              id="cep"
              v-model="transportadoraEditada.cep"
              class="w-full p-2 border rounded-md"
            />
          </div>
          <div class="mb-4">
            <label for="limite_credito" class="block text-gray-700 text-left"
              >Limite de Crédito:</label
            >
            <input
              type="text"
              id="limite_credito"
              v-model="transportadoraEditada.limite_credito"
              class="w-full p-2 border rounded-md"
            />
          </div>
          <div class="mb-4">
            <label
              for="data_analise_credito"
              class="block text-gray-700 text-left"
              >Data de Análise de Crédito:</label
            >
            <input
              type="text"
              id="data_analise_credito"
              v-model="transportadoraEditada.data_analise_credito"
              class="w-full p-2 border rounded-md"
            />
            <input type="hidden" v-model="transportadoraEditada.id" />
          </div>
          <button
            @click="editarTransportadora"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
          >
            Salvar
          </button>
        </form>
      </div>
    </div>
    <div>
      <!-- Modal de Confirmação de Exclusão -->
      <div v-if="showModal" class="fixed z-10 inset-0 overflow-y-auto">
        <div
          class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
        >
          <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
          </div>

          <span
            class="hidden sm:inline-block sm:align-middle sm:h-screen"
            aria-hidden="true"
            >&#8203;</span
          >

          <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
          >
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                  <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Confirmação de Exclusão
                  </h3>
                  <div class="mt-2">
                    <p class="text-sm text-gray-500">
                      Tem certeza de que deseja excluir esta transportadora?
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
            >
              <button
                @click="excluirTransportadora(transportadoraEditada.id)"
                type="button"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
              >
                Excluir
              </button>
              <button
                @click="closeModal"
                type="button"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
              >
                Cancelar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import ExcluirTransportadoraButton from "@/Components/ExcluirTransportadora.vue";
const modalAberto = ref(false);
const showModal = ref(false);
const transportadoraEditada = ref({
  id: "",
  nome: "",
  endereco: "",
  bairro: "",
  cidade: "",
  uf: "",
  cep: "",
  limite_credito: "",
  data_analise_credito: "",
});

const transportadoras = ref([]);

const fecharModal = () => {
  modalAberto.value = false;
};

const editarTransportadora = async (event) => {
  try {
    event.preventDefault();
    // await capturarTransportadora(transportadoraEditada.value.id);
    
    const response = await axios.put(
      `/api/transportadoras/${transportadoraEditada.value.id}`,
      transportadoraEditada.value
    );
    console.log("Resposta da requisição PUT:", response.data);
    await buscarEnderecoPorCEP({ cep: novaTransportadora.value.cep });
    fecharModal();
    carregarTransportadoras();
  } catch (error) {
    console.error("Erro ao editar transportadora:", error);
  }
};

const capturarTransportadora = async (id) => {
  try {
    const response = await axios.get(`/api/transportadoras/${id}`);
    if (response.data) {
      transportadoraEditada.value = response.data;
      console.log(transportadoraEditada.value.id);
    } else {
      console.error("Transportadora não encontrada.");
    }
  } catch (error) {
    console.error("Erro ao buscar transportadora:", error);
  }
};

const abrirModal = () => {
  modalAberto.value = true;
};

async function carregarTransportadoras() {
  try {
    
    const response = await axios.get("/api/transportadoras");
    transportadoras.value = response.data;
    
  } catch (error) {
    console.error("Erro ao carregar transportadoras:", error);
  }
}

const excluirTransportadora = async (id) => {
  try {
    if (!transportadoraEditada.value || !transportadoraEditada.value.id) {
      console.error("A transportadora a ser excluída não está definida.");
      return;
    }

    const id = transportadoraEditada.value.id;
    await axios.delete(`/api/transportadoras/${id}`);
    // Remova a transportadora excluída da lista
    transportadoras.value = transportadoras.value.filter(
      (transportadora) => transportadora.id !== id
    );
    closeModal();
    carregarTransportadoras()
  } catch (error) {
    console.error("Erro ao excluir transportadora:", error);
  }
};

const confirmDelete = async (id) => {
  try {
    const response = await axios.get(`/api/transportadoras/${id}`);
    if (response.data && response.data.id) {
      transportadoraEditada.value = response.data;
      
      showModal.value = true;
    } else {
      console.error("Transportadora não encontrada ou não possui ID.");
    }
  } catch (error) {
    console.error("Erro ao buscar transportadora:", error);
  }
};


const closeModal = () => {
  showModal.value = false;
};

onMounted(async () => {
  carregarTransportadoras();
});
</script>

<style scoped>
/* Estilos específicos do componente */
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