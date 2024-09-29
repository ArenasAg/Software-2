// 1. Principio de Responsabilidad Única (SRP)
// Clase que maneja la creación del pedido
class Order {
    private String item;
    private int quantity;
    
    public Order(String item, int quantity) {
        this.item = item;
        this.quantity = quantity;
    }
    
    public String getItem() {
        return item;
    }
    
    public int getQuantity() {
        return quantity;
    }
}

// Clase que maneja la generación del recibo
class Receipt {
    public void printReceipt(Order order, double amount) {
        System.out.println("Receipt:");
        System.out.println("Item: " + order.getItem());
        System.out.println("Quantity: " + order.getQuantity());
        System.out.println("Amount Paid: $" + amount);
    }
}

// 2. Principio Abierto/Cerrado (OCP)
// Abstraemos el comportamiento de los pagos
interface PaymentMethod {
    void processPayment(double amount);
}

// Implementación concreta para tarjeta de crédito
class CreditCardPayment implements PaymentMethod {
    @Override
    public void processPayment(double amount) {
        System.out.println("Processing credit card payment of $" + amount);
    }
}

// Implementación concreta para PayPal
class PayPalPayment implements PaymentMethod {
    @Override
    public void processPayment(double amount) {
        System.out.println("Processing PayPal payment of $" + amount);
    }
}

// 3. Principio de Sustitución de Liskov (LSP)
// Ambas clases de pago pueden sustituir a la interfaz sin romper el sistema
// Implementamos en el uso de `PaymentMethod` como abstracción

// 4. Principio de Segregación de Interfaces (ISP)
// Separar la lógica de pagos en una interfaz pequeña y específica ya aplicada arriba

// 5. Principio de Inversión de Dependencias (DIP)
// El `CheckoutService` depende de la abstracción `PaymentMethod`, no de implementaciones específicas.
class CheckoutService {
    private PaymentMethod paymentMethod;
    
    public CheckoutService(PaymentMethod paymentMethod) {
        this.paymentMethod = paymentMethod;
    }
    
    public void checkout(Order order, double amount) {
        // Procesar el pago a través de la abstracción
        paymentMethod.processPayment(amount);
        // Imprimir recibo
        Receipt receipt = new Receipt();
        receipt.printReceipt(order, amount);
    }
}

// Ejecución del ejemplo
public class SOLID {
    public static void main(String[] args) {
        // Creamos un pedido
        Order order = new Order("Laptop", 1);
        
        // Seleccionamos el método de pago (puede ser tarjeta de crédito o PayPal)
        PaymentMethod paymentMethod = new CreditCardPayment(); // O también: new PayPalPayment();
        
        // Procesamos el pedido
        CheckoutService checkoutService = new CheckoutService(paymentMethod);
        checkoutService.checkout(order, 1200.00);
    }
}
