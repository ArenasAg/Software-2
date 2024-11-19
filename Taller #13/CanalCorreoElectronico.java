public class CanalCorreoElectronico implements ICanalNotificacion{

    @Override
    public void enviarNotificacion(Notificacion notificacion) {
        System.out.println("Correo Enviado: " + notificacion.getTitulo() + " - " + notificacion.getCuerpo());
    
    }
}
