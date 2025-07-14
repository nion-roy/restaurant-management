<template>
    <AdminLayout>
        <h1 class="text-2xl font-bold text-orange-700 mb-6">Restaurant Dashboard</h1>
        <!-- Quick Stats -->
        <section class="mb-8">
            <h2 class="text-lg font-semibold mb-3 text-gray-700">Quick Stats</h2>
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                <StatCard title="Total Orders" value="1200" color="orange">
                    <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                </StatCard>
                <StatCard title="Total Products" value="85" color="yellow">
                    <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6M9 17v2a2 2 0 002 2h2a2 2 0 002-2v-2" />
                    </svg>
                </StatCard>
                <StatCard title="Total Revenue" value="$15,000" color="green">
                    <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 16v-4" />
                    </svg>
                </StatCard>
                <StatCard title="Total Customers" value="350" color="blue">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 000 7.75" />
                    </svg>
                </StatCard>
            </div>
        </section>

        <!-- Today's Summary -->
        <section class="mb-8">
            <h2 class="text-lg font-semibold mb-3 text-gray-700">Today's Summary</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <StatCard title="Today's Orders" value="45" color="orange">
                    <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                </StatCard>
                <StatCard title="Today's Revenue" value="$1,200" color="green">
                    <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 16v-4" />
                    </svg>
                </StatCard>
                <StatCard title="Pending Orders" value="7" color="red">
                    <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                    </svg>
                </StatCard>
            </div>
        </section>

        <!-- Top Selling Products -->
        <section class="mb-8">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Top Selling Products</h2>
            <div class="bg-gradient-to-r from-orange-50 to-yellow-50 rounded-lg shadow p-6">
                <ul>
                    <li v-for="item in topProducts" :key="item.name" class="flex justify-between py-2 border-b last:border-b-0">
                        <span class="font-medium">{{ item.name }}</span>
                        <span class="font-bold text-orange-600">{{ item.sold }} sold</span>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Recent Orders -->
        <section>
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Recent Orders</h2>
            <div class="bg-white rounded-lg shadow p-6 overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr>
                            <th class="py-2">Order ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in recentOrders" :key="order.id" class="hover:bg-orange-50 transition">
                            <td class="py-2">{{ order.id }}</td>
                            <td>{{ order.customer }}</td>
                            <td>
                                <span :class="order.status === 'Completed' ? 'text-green-600 font-semibold' : 'text-yellow-600 font-semibold'">{{ order.status }}</span>
                            </td>
                            <td>{{ order.amount }}</td>
                            <td>{{ order.time }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from './AdminLayout.vue'
import { defineComponent } from 'vue'

// Demo data
const topProducts = [
    { name: 'Chicken Burger', sold: 120 },
    { name: 'Veg Pizza', sold: 95 },
    { name: 'Cold Coffee', sold: 80 }
]

const recentOrders = [
    { id: 'ORD123', customer: 'Rahim', status: 'Completed', amount: '$25', time: '10:30 AM' },
    { id: 'ORD124', customer: 'Karim', status: 'Pending', amount: '$15', time: '11:00 AM' },
    { id: 'ORD125', customer: 'Sumaiya', status: 'Completed', amount: '$40', time: '11:15 AM' }
]

// StatCard component (local, with slot for icon)
const StatCard = defineComponent({
    name: 'StatCard',
    props: {
        title: String,
        value: String,
        color: String
    },
    template: `
        <div :class="'bg-white rounded-lg shadow p-6 flex flex-col items-center border-t-4 border-' + color + '-400 relative overflow-hidden'">
          <div class='absolute top-2 right-2 opacity-20'>
            <slot></slot>
          </div>
          <span :class="'text-3xl font-bold text-' + color + '-600 mb-1 z-10'">{{ value }}</span>
          <span class='text-gray-600 z-10'>{{ title }}</span>
        </div>
      `
})

defineExpose({ StatCard })
</script>