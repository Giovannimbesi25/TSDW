#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <arpa/inet.h>
#include <netinet/in.h>
#include <sys/socket.h>

#define PORT 3333
#define SERVER_IP "127.0.0.1"

int main() {
    int sockfd;
    struct sockaddr_in server_addr;

    if ((sockfd = socket(AF_INET, SOCK_STREAM, 0)) == -1) {
        perror("Errore nella creazione del socket");
        exit(EXIT_FAILURE);
    }

    server_addr.sin_family = AF_INET;
    server_addr.sin_port = htons(PORT);
    inet_pton(AF_INET, SERVER_IP, &(server_addr.sin_addr));

    if (connect(sockfd, (struct sockaddr*)&server_addr, sizeof(server_addr)) == -1) {
        perror("Errore nella connessione al server");
        close(sockfd);
        exit(EXIT_FAILURE);
    }

    // Leggi la stringa da stdin
    char message[1024];
    printf("Inserisci una stringa: ");
    if (fgets(message, sizeof(message), stdin) == NULL) {
        perror("Errore nella lettura dell'input");
        close(sockfd);
        exit(EXIT_FAILURE);
    }

    // Rimuovi il carattere newline finale se presente
    size_t len = strlen(message);
    if (len > 0 && message[len - 1] == '\n') {
        message[len - 1] = '\0';
    }

    // Invia la stringa al server
    if (send(sockfd, message, strlen(message), 0) == -1) {
        perror("Errore nell'invio dei dati");
        close(sockfd);
        exit(EXIT_FAILURE);
    }

    // Ricevi la risposta dal server
    char buffer[1024];
    memset(buffer, 0, sizeof(buffer));
    if (recv(sockfd, buffer, sizeof(buffer), 0) == -1) {
        perror("Errore nella ricezione dei dati");
    } else {
        printf("Risposta del server: %s\n", buffer);
    }

    close(sockfd);
    return 0;
}
