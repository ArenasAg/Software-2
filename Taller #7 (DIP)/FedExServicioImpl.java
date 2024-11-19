public class FedExServicioImpl implements IFedExEnvio {
    @Override
    public void enviarPorFedEx(Orden orden) {
        System.out.println("Procesando envio a traves de FedEx para la orden: " + orden);

        boolean disponible = verificarDisponibilidadFedEx(orden);
        String numeroSeguimiento = asignarNumeroSeguimientoFedEx(orden);

        if (disponible) {
            System.out.println("Servicio FedEx disponible para esta direccion.");
            System.out.println("Numero de seguimiento FedEx: " + numeroSeguimiento);
        } else {
            System.out.println("Servicio FedEx no disponible para esta direccion.");
        }
    }

    private boolean verificarDisponibilidadFedEx(Orden orden) {
        return !orden.getDireccionEnvio().contains("Cr 33");
    }

    private String asignarNumeroSeguimientoFedEx(Orden orden) {
        return "FedEx-TRACK-67890";
    }
}