<template>
    <div>
        <vue-google-autocomplete
            :id="id"
            classname="form-control"
            placeholder="Please type your address"
            v-on:placechanged="getAddressData"
        >
        </vue-google-autocomplete>  
        
        <!-- <form class="form-horizontal">
          <div class="form-group">
            <label for="street_address" class="col-sm-2 control-label">Street Address</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="street_address" disabled v-model="address.street_number">
            </div>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="route" disabled v-model="address.route">
            </div>
          </div>
          <div class="form-group">
            <label for="city" class="col-sm-2 control-label">City</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" id="city" v-model="address.locality" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="state" class="col-sm-2 control-label">State</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" id="state" v-model="address.administrative_area_level_1" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="postal_code" class="col-sm-2 control-label">Zip Code</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" id="postal_code" v-model="address.postal_code" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="country" class="col-sm-2 control-label">Country</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" id="country" v-model="address.country" disabled>
            </div>
          </div>
        </form> -->

    </div>
</template>

<script>
    export default {
        data: function () {
            return {
              address: '',
              id: _.uniqueId('googleautocomplete_')
            }
        },

        methods: {
            getAddressData: function (addressData) {
                this.address = addressData;
                this.$emit('placechanged', {
                  street: addressData.route,
                  number: addressData.street_number,
                  city: addressData.locality,
                  state: addressData.administrative_area_level_1,
                  zip_code: addressData.postal_code,
                  country: addressData.country,
                  full_address: $(`#${this.id}`).val()
                });
            }
        }
    }
</script>