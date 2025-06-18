<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Products',
        href: '/products',
    },
];

const form = useForm({
    name: '',
    price: '',
    category: '',
});

const handleSubmit = () => {
    form.post(route('products.store'));
};
</script>

<template>
    <Head title="Create a product" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <form @submit.prevent="handleSubmit" class="w-8/12 space-y-4">
                <div class="space-y-2">
                    <Label for="Product name">Name</Label>
                    <Input v-model="form.name" type="text" placeholder="Name" />
                    <div class="text-sm text-red-600">{{ form.errors.name }}</div>
                </div>
                <div class="space-y-2">
                    <Label for="Product Name">Price</Label>
                    <Input v-model="form.price" type="number" placeholder="Price" />
                    <div class="text-sm text-red-600">{{ form.errors.price }}</div>
                </div>
                <div class="space-y-2">
                    <Label for="category">Category</Label>
                    <select
                        v-model="form.category"
                        id="category"
                        class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none"
                    >
                        <option value="">Select category</option>
                        <option value="fruits">Fruits</option>
                        <option value="vegetables">Vegetables</option>
                        <option value="snacks">Snacks</option>
                        <option value="dairy">Dairy</option>
                    </select>
                    <div class="text-sm text-red-600">{{ form.errors.category }}</div>
                </div>
                <Button type="submit">Add Product</Button>
            </form>
        </div>
    </AppLayout>
</template>
