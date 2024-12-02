package Quinta_pregunta;

public class EncenderCelularCommand implements Command {
    private Celular celular;

    public EncenderCelularCommand(Celular celular) {
        this.celular = celular;
    }

    @Override
    public void execute() {
        celular.encender();
    }
}