public class Main {
    public static void main(String[] args) {
        Orden orden = new Orden("1", "Compra de computadores", "Cr 33, Colombia");

        // Usar UPS
        IUPSEnvio upsServicio = new UPSServicioImpl();
        IFedExEnvio fedExServicio = new FedExServicioImpl();
        IDHLEnvio dhlServicio = new DHLServicioImpl();

        SistemaEnvios sistema = new SistemaEnvios(dhlServicio, fedExServicio, upsServicio);

        // Usar UPS
        sistema.enviarPorUPS(orden);

        // Usar FedEx
        sistema.enviarPorFedEx(orden);

        // Usar DHL
        sistema.enviarPorDHL(orden);
    }
}
