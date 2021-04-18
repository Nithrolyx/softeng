<template>
    <div>
        <Layout>
            <div class="flex justify-center w-full">
                <div class="bg-white flex flex-col w-1/3 mt-20 p-6">
                    <h2 class="text-lg">Stock Form</h2>
                    <form
                        id="stock-form"
                        name="stock-form"
                        v-on:submit.prevent="submit"
                    >
                        <div class="flex flex-col pt-6">
                            <label for="id">ID</label>
                            <input
                                type="text"
                                id="id"
                                name="id"
                                v-model="form.id"
                                autocomplete="off"
                            />
                            <div class="text-red-700 text-sm">
                                {{ errors.id }}
                            </div>
                            {{ form.id }}
                        </div>

                        <div class="flex flex-col pt-6">
                            <label for="stock_category_id">Stock Category ID</label>
                            <select name="type" id="type" v-model="form.stock_category_id">
                                <option value="15271">15271</option>
                                <option value="20206">20206</option>
                                <option value="2524">2524</option>
                                <option value="27318">27318</option>
                                <option value="28545">28545</option>
                                <option value="29644">29644</option>
                                <option value="35078">35078</option>
                                <option value="35525">35525</option>
                                <option value="36350">36350</option>
                                <option value="39408">39408</option>
                                <option value="40914">40914</option>
                                <option value="42080">42080</option>
                                <option value="43375">43375</option>
                                <option value="50134">50134</option>
                                <option value="51393">51393</option>
                                <option value="52">52</option>
                                <option value="63426">63426</option>
                                <option value="6798">6798</option>
                                <option value="7837">7837</option>

                            </select>
                            <div class="text-red-700 text-sm">
                                {{ errors.stock_category_id }}
                            </div>
                        </div>

                        <div class="flex flex-col pt-6">
                            <label for="description">Description</label>
                            <input
                                type="text"
                                id="description"
                                name="description"
                                v-model="form.description"
                                autocomplete="off"
                            />
                            <div class="text-red-700 text-sm">
                                {{ errors.description }}
                            </div>
                        </div>
   
                        <div class="flex flex-col pt-6">
                            <label for="uom">UOM</label>
                            <input
                                type="text"
                                id="uom"
                                name="uom"
                                v-model="form.uom"
                            />
                            <div class="text-red-700 text-sm">
                                {{ errors.uom }}
                            </div>
                        </div>

                        <div class="flex flex-col pt-6">
                            <label for="barcode">Barcode</label>
                            <input
                                type="text"
                                id="barcode"
                                name="barcode"
                                v-model="form.barcode"
                            />
                            <div class="text-red-700 text-sm">
                                {{ errors.barcode }}
                            </div>
                        </div>   
                        
                        <div class="flex flex-col pt-6">
                            <label for="discontinued">Discontinued</label>
                            <input
                                type="checkbox"
                                id="discontinued"
                                name="discontinued"
                                v-model="form.discontinued"
                                true-value="Y"
                                false-value="N"
                                autocomplete="off"
                            />
                            <div class="text-red-700 text-sm">
                                {{ errors.discontinued }}
                            </div>
                        </div>     
<!-----                  
                        <div class="flex flex-col pt-6">
                            <label for="photo_path">Photo Path</label>
                            <input
                                type="text"
                                id="photo_path"
                                name="photo_path"
                                v-model="form.photo_path"
                                autocomplete="off"
                            />
                            <div class="text-red-700 text-sm">
                                {{ errors.photo_path }}
                            </div>
                        </div>                                                                     
--->

                        <div class="flex flex-col pt-6">
                            <button
                                type="submit"
                                class="bg-indigo-800 text-white p-2"
                            >
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </Layout>
    </div>
</template>

<script>
import { ref, reactive } from "vue";
import Layout from "@/Layouts/Authenticated";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        Layout,
    },

    props: {
        errors: Object,
    },

    setup(props, context) {
        const form = reactive({
            id: null,
            stock_category_id: null,   
            description: null,
            uom: null,
            barcode: null,
            discontinued: "N",

        });

        const submit = () => {
            Inertia.post(route("stock.store"), form, {
                onSuccess: () => {
                    // Handle success event
                    form.id = null;
                    form.stock_category_id = null;
                    form.description = null;                   
                    form.uom = null;
                    form.barcode = null;
                    form.discontinued = "N";                  
                    //   this.reset();
                },
            });
        };

        return {
            form,
            submit,
        };
    },
};
</script>
