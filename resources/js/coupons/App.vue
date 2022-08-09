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
                    <div class="form-control-wrap">
                      <input type="text" class="form-control"
                        :id="`title[${i}]`"
                        v-model="coupon.title"
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
                      <select :id="`type[${i}]`" class="form-control" v-model="coupon.type" required>
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
                      <select :id="`color[${i}]`" class="form-control" v-model="coupon.color" required>
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
                      <input type="text" class="form-control"
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
                      <textarea class="form-control form-control-sm"
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
                      <select :id="`button_type[${i}]`" class="form-control" v-model="coupon['button_type']" required>
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
                      <input type="text" class="form-control"
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
                      <input type="datetime-local" class="form-control"
                        :id="`start_at[${i}]`"
                        v-model="coupon['start_at']" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label" :for="`end_at[${i}]`">End</label>
                    <div class="form-control-wrap">
                      <input type="datetime-local" class="form-control"
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
      <div class="row g-gs">
        <div class="col-12">
          <div class="form-group">
            <button class="btn btn-lg btn-outline-primary" @click="addCoupon">Добавить купон или акцию</button>
          </div>
        </div>
      </div>
    </div>
    <div class="nk-block" v-if="coupons.length">
      <div class="row g-gs">
        <div class="col-12">
          <div class="form-group">
            <button class="btn btn-lg btn-primary">Сохранить</button>
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
      coupons: [],
      options: {
        colorsList: {},
        typesList: [],
        buttonTypesList: [],
        action: ''
      },
    };
  },
  created () {
    const data = document.getElementById('data_options');
    this.options.colorsList = JSON.parse(data.dataset['colors'] || '[]');
    this.options.typesList = JSON.parse(data.dataset['types'] || '[]');
    this.options.buttonTypesList = JSON.parse(data.dataset['buttons'] || '[]');
    this.options.action = data.dataset['action'] || '';
    this.coupons = JSON.parse(data.dataset['coupons'] || '[]');
  },
  methods: {
    addCoupon() {
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
    }
  }
};
</script>

<style lang="scss">
[v-cloak], [hidden] {
  display: none;
}
</style>