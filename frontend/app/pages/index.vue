<template>
    <form @submit.prevent="submitForm">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input v-model="form.email" type="text" class="form-control" id="exampleInputEmail1">

            <div v-if="form.dataEmailMessage" class="text-danger"> {{ form.dataEmailMessage }} </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input v-model="form.password" type="text" class="form-control" id="password">
            <div class="form-text">กรุณากรอก Password</div>
        </div>
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input v-model="form.confirmPassword" type="text" class="form-control" id="confirmPassword">
            <div class="form-text">กรุณายืนยัน Password</div>
        </div>

        <div v-if="form.dataPasswordMessage" class="text-danger"> {{ form.dataPasswordMessage }} </div>
        <div v-if="form.dataPasswordRexMessage" class="text-danger"> {{ form.dataPasswordRexMessage }} </div>
        <button :disabled="!isSubmit" type="submit" class="btn btn-primary">ยืนยัน</button>
    </form>

    <NuxtLink :to="'challenge/2'" >
        <button type="button" class="btn btn-danger mt-5">Challenge 2</button>
    </NuxtLink>
</template>

<script setup lang="ts">
import { reactive, computed, watch } from 'vue';

const isSubmit = ref(false);
const form = reactive({
    email: '' as any,
    password: '' as any,
    confirmPassword: '' as any,
    dataEmailMessage: '',
    dataPasswordMessage: '',
    dataPasswordRexMessage: ''
});
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const passwordRegex =
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;
const isStrongComputed = computed(() => {
    return passwordRegex.test(form.password);
})
const submitForm = () => {
    if (!emailRegex.test(form.email)) {
        form.dataEmailMessage = 'กรุณากรอก Emailให้ถูกต้อง';
    } else {
        form.dataEmailMessage = '';
    }
    if (form.password !== form.confirmPassword) {
        form.dataPasswordMessage = 'Password ไม่ตรงกัน';
    }
    else {
        form.dataPasswordMessage = '';
    }
    if (!isStrongComputed.value) {
        form.dataPasswordRexMessage = 'Password ต้องอย่างน้อย 8 ตัว และต้องมีตัวอักษรตัวใหญ่ ตัวเล็ก ตัวเลข และอักษรพิเศษ';
    } else {
        form.dataPasswordRexMessage = '';
    }

}

watch(form, (value) => {
    if (value.email && value.password && value.confirmPassword) {
        isSubmit.value = true;
    }
})
</script>

<style lang="scss" scoped></style>