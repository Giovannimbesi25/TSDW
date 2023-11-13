#include<arpa/inet.h>
#include<string.h>
#include<stdio.h>
#include<stdlib.h>
#include<libgen.h>
#include<unistd.h>

#define BUFFER_SIZE 64

int main(int argc, char** argv){
  int sockfd, n;
  struct sockaddr_in remote_addr;
  socklen_t len = sizeof(struct sockaddr_in);
  char buffer[BUFFER_SIZE];

  if(argc != 3){
    printf("Usage ./%s <ip> <port>\n", basename(argv[0]));
    return EXIT_FAILURE;
  }

  if((sockfd = socket(AF_INET, SOCK_STREAM, 0)) < 0){
    perror("socket()");
    return EXIT_FAILURE;
  }

  memset(&remote_addr, 0, len);
  remote_addr.sin_addr.s_addr = inet_addr(argv[1]);
  remote_addr.sin_port = htons(atoi(argv[2]));
  remote_addr.sin_family = AF_INET;

  if((connect(sockfd, (struct sockaddr*)&remote_addr, len)) < 0){
    perror("connect");
    return EXIT_FAILURE;
  }

  while(1){
    printf("Send a message or 'exit' to quit\n");
    fgets(buffer, BUFFER_SIZE , stdin);

    if(strcmp(buffer, "exit\n"));

    if((send(sockfd, buffer, strlen(buffer), 0)) < 0){
      perror("send");
      return EXIT_FAILURE;
    }

    if((n = recv(sockfd, &buffer, BUFFER_SIZE, 0)) < 0){
      perror("recv()");
      return EXIT_FAILURE;
    }

    buffer[n] = '\0';

    printf("%s", buffer);

    close(sockfd);

  }



}