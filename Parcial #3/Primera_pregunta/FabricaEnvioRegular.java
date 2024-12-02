package Primera_pregunta;

public class FabricaEnvioRegular implements FabricaServicioEnvio {
    @Override
    public ServicioEnvio crearServicioEnvio() {
        return new ServicioEnvioRegular();
    }
}