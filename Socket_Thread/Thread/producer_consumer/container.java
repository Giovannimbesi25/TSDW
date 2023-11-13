public class container {
    private int contents;
    private boolean available = false;

    public synchronized int get() {
        while (available == false) {
            try {
                // attende che un dato sia disponibile
                wait();
            } catch (InterruptedException e) { }
        }
        available = false;
        // notifica che un dato e' stato consumato ed
        // un produttore puo' inserirne un altro
        notifyAll();
        return contents;
    }

    public synchronized void put(int value) {
        while (available == true) {
            try {
                // attende che un dato sia consumato
                wait();
            } catch (InterruptedException e) { }
        }
        contents = value;
        available = true;
        // notifica che un dato e' stato inserito
        notifyAll();
    }
}

// Il metodo notifyAll() in Java è utilizzato per notificare tutti i thread in attesa 
// su un oggetto monitor (un oggetto sincronizzato) che sono bloccati da un'operazione wait(). 
// Questo metodo invia una notifica a tutti i thread in attesa, consentendo loro di competere 
// per ottenere il blocco e proseguire l'esecuzione.