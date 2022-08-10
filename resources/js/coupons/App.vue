<template>
  <div>
    <div class="nk-block">
      <div class="row g-gs">
        <div class="col-lg-6" v-for="(coupon, i) in coupons">
          <div class="card card-bordered">
            <div class="card-inner">
              <div class="row g-gs">
                <div class="col-12">
                  <div class="form-group">
                    <label class="form-label" :for="`title[${i}]`">Заголовок</label>
                    <a href="#" class="close" aria-label="Close" @click.prevent="removeCoupon(i)">
                      <em class="icon ni ni-cross"></em>
                    </a>
                    <div class="form-control-wrap">
                      <input type="text" class="form-control" :class="[errors[`coupons.${i}.title`] ? 'error' : '']"
                        :id="`title[${i}]`"
                        v-model.trim="coupon.title"
                        placeholder="Например: Самая крутая акция" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row g-gs">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label" :for="`type[${i}]`">Тип</label>
                    <div class="form-control-wrap">
                      <select :id="`type[${i}]`" class="form-control" :class="[errors[`coupons.${i}.type`] ? 'error' : '']"
                        v-model="coupon.type" required>
                        <option disabled value="">Выберите тип</option>
                        <option v-for="(type, key) in options.typesList" v-bind:value="key">{{ type }}</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label" :for="`color[${i}]`">Цвет</label>
                    <div class="form-control-wrap">
                      <select :id="`color[${i}]`" class="form-control" :class="[errors[`coupons.${i}.color`] ? 'error' : '']"
                        v-model="coupon.color" required>
                        <option disabled value="">Выберите цвет</option>
                        <option v-for="(color, key) in options.colorsList" v-bind:value="key">{{ color }}</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label" :for="`type_content[${i}]`">Значение</label>
                    <div class="form-control-wrap">
                      <input type="text" class="form-control" :class="[errors[`coupons.${i}.type_content`] ? 'error' : '']"
                        :id="`type_content[${i}]`"
                        v-model="coupon['type_content']"
                        placeholder="10%" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row g-gs">
                <div class="col-12">
                  <div class="form-group">
                    <label class="form-label" :for="`content[${i}]`">Контент</label>
                    <div class="form-control-wrap">
                      <textarea class="form-control form-control-sm" :class="[errors[`coupons.${i}.content`] ? 'error' : '']"
                        :id="`content[${i}]`"
                        v-model="coupon['content']"
                        placeholder="Описание" required></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row g-gs">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label" :for="`button_type[${i}]`">Тип кнопки</label>
                    <div class="form-control-wrap">
                      <select :id="`button_type[${i}]`" class="form-control" :class="[errors[`coupons.${i}.button_type`] ? 'error' : '']"
                        v-model="coupon['button_type']" required>
                        <option disabled value="">Выберите тип</option>
                        <option v-for="(type, key) in options.buttonTypesList" v-bind:value="key">{{ type }}</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label" :for="`button_content[${i}]`">Значение кнопки</label>
                    <div class="form-control-wrap">
                      <input type="text" class="form-control" :class="[errors[`coupons.${i}.button_content`] ? 'error' : '']"
                        :id="`button_content[${i}]`"
                        v-model="coupon['button_content']"
                        placeholder="QWERTY"
                        required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row g-gs">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label" :for="`start_at[${i}]`">Start</label>
                    <div class="form-control-wrap">
                      <input type="datetime-local" class="form-control" :class="[errors[`coupons.${i}.start_at`] ? 'error' : '']"
                        :id="`start_at[${i}]`"
                        v-model="coupon['start_at']" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label" :for="`end_at[${i}]`">End</label>
                    <div class="form-control-wrap">
                      <input type="datetime-local" class="form-control" :class="[errors[`coupons.${i}.end_at`] ? 'error' : '']"
                        :id="`end_at[${i}]`"
                        v-model="coupon['end_at']" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="nk-block">
      <div class="d-flex justify-content-between">
        <div class="form-group">
          <button class="btn btn-lg btn-outline-primary" type="button" @click="addCoupon">Добавить купон или акцию</button>
        </div>
        <div class="form-group" v-if="changed" @click="setOld">
          <button class="btn btn-lg btn-outline-danger">Отменить</button>
        </div>
      </div>
    </div>
    <div class="nk-block" v-if="changed">
      <div class="row g-gs">
        <div class="col-12">
          <div class="form-group">
            <button class="btn btn-lg btn-primary" @click="save" :disabled="lock">Сохранить</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  data () {
    return {
      old: [],
      coupons: [],
      options: {
        colorsList: {},
        typesList: [],
        buttonTypesList: [],
        action: ''
      },
      errors: {},
      changed: false,
      lock: false
    };
  },
  watch: {},
  created () {
    const data = document.getElementById('data_options');
    this.options.colorsList = JSON.parse(data.dataset['colors'] || '[]');
    this.options.typesList = JSON.parse(data.dataset['types'] || '[]');
    this.options.buttonTypesList = JSON.parse(data.dataset['buttons'] || '[]');
    this.options.action = data.dataset['action'] || '';
    this.coupons = JSON.parse(data.dataset['coupons'] || '[]');
    if (this.coupons.length) {
      this.changed = true;
      this.old = JSON.parse(JSON.stringify(this.coupons));
    }
  },
  methods: {
    addCoupon () {
      this.coupons.push({
        color: '',
        type: '',
        type_content: '',
        title: '',
        content: '',
        button_type: '',
        button_content: '',
        start_at: '',
        end_at: '',
      });
      this.changed = true;
    },
    removeCoupon (i) {
      this.coupons.splice(i, 1);
      this.errors = {};
    },
    setOld () {
      if (confirm('Отменить все действия?')) {
        this.coupons = JSON.parse(JSON.stringify(this.old));
        this.errors = {};
      }
    },
    save () {
      this.lock = true;

      $.post(this.options.action, { coupons: this.coupons }, null, 'json')
        .done((json) => {
          if ('response' in json && json['response'] === 'OK') {
            this.old = JSON.parse(JSON.stringify(this.coupons));
            this.errors = {};
            Swal.fire('👌', 'Изменения сохранены!', 'success',);
          }
        })
        .fail((err) => {
          if (422 === err.status) {
            this.errors = err['responseJSON']['errors'];
            Swal.fire('Ошибка', 'Заполните корректно все поля!', 'error',);
          }
        })
        .always(_ => this.lock = false);
    }
  }
};
</script>

<style lang="scss">
[v-cloak], [hidden] {
  display: none;
}
</style>