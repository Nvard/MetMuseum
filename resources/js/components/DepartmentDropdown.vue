<template>
    <div class="form-group">
        <select id="department" class="form-control" @change="onSelect($event.target.value)">
            <option value="">Select Department</option>
            <option v-for="dept in departments" :key="dept.departmentId" :value="dept.departmentId">
                {{ dept.displayName }}
            </option>
        </select>
    </div>
</template>


<script>
    export default {
        props: ['departments'],
        methods: {
            onSelect(value) {
                this.$emit('select', value);
            },
        },
    };
</script>
