public class DHLServicioImpl implements IDHLEnvio {
    @Override
    public void enviarPorDHL(Orden orden) {
        System.out.println("Procesando envio a traves de DHL para la orden: " + orden);

        boolean direccionValida = validarDireccionDHL(orden);
        if (direccionValida) {
            notificarDHL(orden);
        } else {
            System.out.println("Direccion invalida para DHL: " + orden.getDireccionEnvio());
        }
    }

    private boolean validarDireccionDHL(Orden orden) {
        return !orden.getDireccionEnvio().contains("Colombia");
    }

    private void notificarDHL(Orden orden) {
        System.out.println("Notificacion de envio enviada a DHL para la orden: " + orden.getId());
    }
}
