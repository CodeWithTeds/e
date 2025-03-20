<?php
require_once 'Views/includes/head.php';
require_once 'Views/includes/header.php';
require_once 'Views/includes/navbar.php';
require_once 'Views/components/admin.component.php';
?>

<div class="ml-[250px] p-8">
    <h1 class="text-3xl font-bold mb-8">Admin Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Products Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-500 bg-opacity-75">
                    <iconify-icon icon="material-symbols:inventory-2" class="w-8 h-8 text-white"></iconify-icon>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Total Products Available</p>
                    <p class="text-lg font-semibold text-gray-700"><?php echo $totalProducts; ?></p>
                </div>
            </div>
    </div>

        <!-- Total Orders Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-500 bg-opacity-75">
                    <iconify-icon icon="material-symbols:shopping-cart" class="w-8 h-8 text-white"></iconify-icon>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Total Orders</p>
                    <p class="text-lg font-semibold text-gray-700"><?php echo $totalOrders; ?></p>
                </div>
            </div>
        </div>

        <!-- Staff Stats Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-500 bg-opacity-75">
                    <iconify-icon icon="mdi:users" class="w-8 h-8 text-white"></iconify-icon>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Staff Members</p>
                    <p class="text-lg font-semibold text-gray-700">
                        <?php echo $staffStats->active; ?> <span class="text-sm text-gray-500">active</span> / 
                        <?php echo $staffStats->total; ?> <span class="text-sm text-gray-500">total</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Driver Stats Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-500 bg-opacity-75">
                    <iconify-icon icon="mdi:truck-delivery" class="w-8 h-8 text-white"></iconify-icon>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Delivery Drivers</p>
                    <p class="text-lg font-semibold text-gray-700">
                        <?php echo $driverStats->active; ?> <span class="text-sm text-gray-500">active</span> / 
                        <?php echo $driverStats->total; ?> <span class="text-sm text-gray-500">total</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Daily Sales Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-emerald-500 bg-opacity-75">
                    <span class="text-white text-2xl font-bold">₱</span>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Today's Sales</p>
                    <p class="text-lg font-semibold text-gray-700">
                        ₱<?php echo number_format($todaySales, 2); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Weekly Sales Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-500 bg-opacity-75">
                    <span class="text-white text-2xl font-bold">₱</span>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Weekly Sales</p>
                    <p class="text-lg font-semibold text-gray-700">
                        ₱<?php echo number_format($weeklySales, 2); ?>
                    </p>
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
        <!-- Recent Orders Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Recent Orders</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach (array_slice($orders, 0, 5) as $order): ?>
                            <tr>
                            <td class="px-6 py-4 whitespace-nowrap">#<?php echo $order->id; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $order->user_email; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php
                                    switch($order->payment_status) {
                                        case 'paid':
                                            echo 'bg-green-100 text-green-800';
                                            break;
                                        case 'pending':
                                            echo 'bg-yellow-100 text-yellow-800';
                                            break;
                                        case 'failed':
                                        case 'cancelled':
                                            echo 'bg-red-100 text-red-800';
                                            break;
                                        default:
                                            echo 'bg-gray-100 text-gray-800';
                                    }
                                    ?>">
                                    <?php echo ucfirst($order->payment_status); ?>
                                    </span>
                                </td>
                            <td class="px-6 py-4 whitespace-nowrap">₱<?php echo number_format($order->total_amount, 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Stock Adjustments -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Recent Stock Adjustments</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Size</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Adjustment</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">By</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($recentAdjustments as $adjustment): ?>
                            <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $adjustment->product_name; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $adjustment->size; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php echo $adjustment->adjustment_amount > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                    <?php echo $adjustment->adjustment_amount > 0 ? '+' : ''; ?><?php echo $adjustment->adjustment_amount; ?>
                                    </span>
                                </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $adjustment->reason; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $adjustment->staff_name ?? 'System'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
