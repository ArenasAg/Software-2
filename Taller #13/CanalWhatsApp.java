public class CanalWhatsApp implements ICanalNotificacion{

    @Override
    public void enviarNotificacion(Notificacion notificacion) {
        System.out.println("WhatsApp Enviado: " + notificacion.getTitulo() + " - " + notificacion.getCuerpo());
        
    }

}