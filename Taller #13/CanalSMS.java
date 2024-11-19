public class CanalSMS implements ICanalNotificacion{

    @Override
    public void enviarNotificacion(Notificacion notificacion) {
        System.out.println("SMS Enviado: " + notificacion.getTitulo() + " - " + notificacion.getCuerpo());
        
    }
}