<template>
  <section class="m-5">
    <div class="text-light" v-if="User">
      <div class="bg-primary py-3 rounded">
        <div class="row align-items-center">

          <div class="col-sm-2 col-md-2 text-center text-md-start d-flex justify-content-center m-2">
            <img :src="User.avatar" class="img-thumbnail rounded-circle" alt="Avatar" height="150" width="150" id="avatar">
          </div>

          <div class="col-12 col-md-8">

            <h1>{{ User.nome }}</h1>
            <p class="text-break" v-if="User.bio"><strong>Bio:</strong> {{ User.bio }}</p>



            <div class="row">

              <div class="col-12 col-md-6">
                <p><strong>GitHub:</strong> {{ User.usuario }}</p>
              </div>
              <div class="col-12 col-md-6">
                <p class="text-break" v-if="User.blog"><strong>Blog:</strong> <a :href="User.blog" target="_blank" class="link-light">{{ User.blog }}</a></p>
              </div>
              <div class="col-12">
                <p v-if="User.localizacao"><strong>Localização:</strong> {{ User.localizacao }}</p>
              </div>

            </div>
          </div>

          <div class="col-sm-6 col-md-6 col-lg-12">
            <div class="d-flex justify-content-end mx-3">
              <a class="btn btn-sm btn-danger" :href="User.url" target="_blank">Acessar</a>
            </div>
          </div>
        </div>

      </div>


      <div class="col-sm-8 col-md-4 col-lg-5 mt-5">
        <div class="card">
          <div class="card-body">
            <h4 class="header-title mt-0 mb-3">Outras Informações</h4>
            <hr>
            <div class="text-start">
              <p class="text-muted">
                <strong>Reposistorios :</strong>
                <span class="ms-2"> {{ User.reposistorios_publicos }} </span>
              </p>
              <p class="text-muted" type="button" @click="openModal('Seguidores')"><strong>Seguidores :</strong>
                <span class="ms-2"> {{ User.seguidores }} </span>
              </p>
              <p class="text-muted" type="button" @click="openModal('Seguindo')"><strong>Seguindo :</strong>
                <span class="ms-2"> {{ User.seguindo }}</span>
              </p>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <Modal v-if="Visible" :usuarios="usuarios" :title="title" :showModal="Visible" @close="closeModal" />
</template>

<script>
import Modal from './components/modal.vue';
import axios from 'axios';
export default {

  name: 'HomeUsers',

  components: {
    Modal,
  },

  data() {
    return {
      title: '',
      Visible: false,
      usuarios: [],
    };
  },


  methods: {
    openModal(modalTitle) {
      this.title = modalTitle;
      this.Visible = true;
      this.usuarios = [];

      if (this.title == 'Seguidores') {
        return this.getSeguidores();
      }
      return this.getSeguindo();

    },
    closeModal() {
      this.Visible = false;
    },

    getSeguidores() {
      const URL = location.href;
      axios.get(`${URL}/followers`)
        .then(response => {
          this.usuarios = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },

    getSeguindo() {
      const URL = location.href;
      axios.get(`${URL}/following`)
        .then(response => {
          this.usuarios = response.data;
        })
        .catch(error => {
          console.error(error);
        });

    }

  },

  props: {
    User: {
      type: Object,
      required: true, // Torna a prop obrigatória
    },
  },


};
</script>

<style></style>
