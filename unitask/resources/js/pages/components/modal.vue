<template>
  <div class="modal" tabindex="-1" :class="{ show: showModal }" :style="{ display: showModal ? 'block' : 'none' }">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Lista de {{ title }}</h5>
          <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div v-if="usuarios.length > 0">
            <input type="text" v-model="searchQuery" class="form-control" placeholder="Pesquisar..." />
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Avatar</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Acessar</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="seguidor in filtroUsuarios" :key="seguidor.usuario">
                  <td>
                    <img :src="seguidor.avatar" class="rounded" alt="..." height="20">
                  </td>
                  <td>{{ seguidor.usuario }}</td>
                  <td><a class="btn btn-sm btn-danger" :href="seguidor.url" target="_blank">Acessar</a></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div v-else>
            <div class="d-flex justify-content-center">
              <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="closeModal">Fechar</button>

        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {

  props: {
    showModal: {
      type: Boolean,
      default: false,
    },
    title: {
      type: String,
      default: '',
      required: true,
    },
    usuarios: {
      type: Array,
      default: () => [],
      required: true
    }
  },

  data() {
    return {
      pesquisa: ''
    };
  },
  computed: {
    filtroUsuarios() {
      const usuarioPesquisado = this.pesquisa.toLowerCase();
      return this.usuarios.filter(usuario =>
        usuario.usuario.toLowerCase().includes(usuarioPesquisado)
      );
    }
  },


  methods: {
    closeModal() {
      this.$emit('close');
    },
  },






};
</script>

<style scoped>
.modal.show {
  display: block;
  opacity: 1;
  transition: opacity 0.15s linear;
}
</style>