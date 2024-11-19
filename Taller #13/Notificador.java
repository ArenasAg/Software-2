public class Notificador{
    private ICanalNotificacion canal;
    public Notificador(ICanalNotificacion canal){
        this.canal = canal;
    }
    public void setCanal(ICanalNotificacion nuevoCanal) {
        this.canal = nuevoCanal;
    }
    public void enviarNotificacion(Notificacion notificaion){
        canal.enviarNotificacion(notificaion);
    }

}