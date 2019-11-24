<template>
  <div>
    <b-container>
      <b-row class="justify-content-md-center">
        <b-col cols="8" class="mybg">
          <b-form @submit="onSubmit" class="mt-3">
            <label class="mytitle">Registration</label>
            <b-form-group>
              <b-form-input
                :disabled="isDisabled"
                v-model="form.mobile_number"
                required
                placeholder="Mobile number"
              ></b-form-input>
              <code v-if="errors.mobile_number" class="has-text-danger">{{errors.mobile_number[0]}}</code>
            </b-form-group>
            <b-form-group>
              <b-form-input
                :disabled="isDisabled"
                v-model="form.first_name"
                required
                placeholder="First name"
              ></b-form-input>
			  <code v-if="errors.first_name" class="has-text-danger">{{errors.first_name[0]}}</code>
            </b-form-group>

            <b-form-group>
              <b-form-input
                :disabled="isDisabled"
                v-model="form.last_name"
                required
                placeholder="Last name"
              ></b-form-input>
			  <code v-if="errors.last_name" class="has-text-danger">{{errors.last_name[0]}}</code>
            </b-form-group>

            <b-form-group id="input-group-3" label="Date of Birth" label-for="input-3">
              <b-row>
                <b-col cols="2">
                  <b-form-select
				  	:required="isDateRequired"
                    :disabled="isDisabled"
                    v-model="form.month"
                    :options="month_options"
                  ></b-form-select>
                </b-col>
                <b-col cols="2">
                  <b-form-select :required="isDateRequired" :disabled="isDisabled" v-model="form.date" :options="date_options"></b-form-select>
                </b-col>
                <b-col cols="2">
                  <b-form-select :required="isDateRequired" :disabled="isDisabled" v-model="form.year" :options="year_options"></b-form-select>
                </b-col>
              </b-row>
            </b-form-group>

            <b-form-group>
              <b-form-radio-group
                :disabled="isDisabled"
                v-model="form.gender"
                :options="gender_options"
              ></b-form-radio-group>
            </b-form-group>

            <b-form-group>
              <b-form-input
                :disabled="isDisabled"
                v-model="form.email"
                type="email"
                required
                placeholder="Email"
              ></b-form-input>
              <code v-if="errors.email" class="has-text-danger">{{errors.email[0]}}</code>
            </b-form-group>

            <b-button block type="submit" size="lg" class="mybg-purple mb-3">Register</b-button>
          </b-form>
          <router-link v-if="isSaved" to="/signin">
            <b-button block size="lg" class="mybg-purple mb-3">Login</b-button>
          </router-link>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import { log } from "util";
export default {
  data() {
    return {
      isDisabled: false,
	  isSaved: false,
	  errors: {},

      form: {
        first_name: "",
        last_name: "",
        mobile_number: null,
        email: "",
        gender: "",
        month: "",
        date: "",
		year: "",
		birth_date: null,
      },
      gender_options: [
        { text: "Male", value: "male" },
        { text: "Female", value: "female" }
      ],
      month_options: [
        { text: "Month", value: "" },
        { text: "January", value: { number: "01", length: 31 } },
        { text: "February", value: { number: "02", length: 28 } },
        { text: "March", value: { number: "03", length: 31 } },
        { text: "April", value: { number: "04", length: 30 } },
        { text: "May", value: { number: "05", length: 31 } },
        { text: "June", value: { number: "06", length: 30 } },
        { text: "July", value: { number: "07", length: 31 } },
        { text: "August", value: { number: "08", length: 31 } },
        { text: "September", value: { number: "09", length: 30 } },
        { text: "October", value: { number: "10", length: 31 } },
        { text: "November", value: { number: "11", length: 30 } },
        { text: "December", value: { number: "12", length: 31 } }
      ],
    };
  },
  computed: {
    date_options() {
      if (this.form.month != "") {
        let options = [{ text: "Date", value: "" }];
		let length = this.form.month.length;
		if (this.form.year != "" && this.form.year % 4 == 0) {
			length = 29;
		}
        for (let index = 0; index < length; index++) {
          options.push({
            text: index + 1,
            value: index + 1
          });
        }
        return options;
      } else {
        return [{ text: "Date", value: "" }];
      }
    },
    year_options() {
      let options = [{ text: "Year", value: "" }];
      for (let index = 2020; index >= 1900; index--) {
        options.push({
          text: index,
          value: index
        });
      }
      return options;
	},
	isDateRequired(){
		if (this.form.month != "" || this.form.date != "" || this.form.year != "") {
			return true;
		} else {
			return false;
		}
	}
  },
  mounted() {
    
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
	  this.toggleDisableForm();
	  if (this.isDateRequired) {
		  let day = this.form.date;
		  if (day.toString().length == 1) {
			  day = '0'+day;
		  }
		  this.form.birth_date = this.form.year + '-' + this.form.month.number + '-' + day;
	  }
      axios
        .post("/", this.form)
        .then(response => {
          console.log(response);
          this.errors = {};
          this.toggleDisableForm();
          this.isSaved = true;
        })
        .catch(error => {
          console.log(error.response);
          this.toggleDisableForm();
          this.isSaved = false;
          this.errors = error.response.data.errors;
        });
    },
    toggleDisableForm() {
      this.isDisabled = !this.isDisabled;
    }
  }
};
</script>

<style>
.mytitle {
  font-size: larger;
}

.mybg {
  background-color: #f8f8f8;
}

.mybg-purple,
.btn:hover {
  background-color: blueviolet;
  border-color: blueviolet;
}
</style>