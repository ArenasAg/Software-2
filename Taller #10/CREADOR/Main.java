public class Main {
    public static void main(String[] args) {
        Orden orden = new Orden();
        orden.agregarComputadora("Intel i7", "NVIDIA GTX 1080", 16);
        orden.agregarComputadora("AMD Ryzen 5", "AMD Radeon RX 580", 8);

        System.out.println("Total de Computadoras: " + orden.calcularTotalComputadoras());
    }
}