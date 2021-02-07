#include <stdio.h>
#include <string.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <unistd.h>
#include <arpa/inet.h>

#define PORT 9025

int main() {
    //creating a socket based on TCP
    int socket_holder;
    if((socket_holder = socket(AF_INET, SOCK_STREAM,0))<0){
        printf("Failed to create socket.\n");
        return -1;
    }
    //creating address for the socket
    struct sockaddr_in server_address;
    server_address.sin_family = AF_INET;
    server_address.sin_addr.s_addr = INADDR_ANY;
    server_address.sin_port = htons(PORT);

    //defining and checking connection status
    int connection_status = connect(socket_holder, (struct sockaddr *) &server_address, sizeof(server_address));
    if (connection_status < 0) {
        printf("An error occurred on trying to connect to the server.");
        return -1;
    }

    //data exchange with server
    char server_feedback[13000], client_input[150];
    memset(server_feedback, 0, sizeof(server_feedback));
    while (1){
        recv(socket_holder, server_feedback, sizeof(server_feedback), 0);
        if (strncmp("Your district is:", server_feedback,17)==0){
            printf("\n%s", server_feedback);
            memset(client_input, 0, sizeof(client_input));
            fgets(client_input, sizeof(client_input),stdin);
            send(socket_holder,client_input, strlen(client_input),0);
            memset(server_feedback, 0, sizeof(server_feedback));
            recv(socket_holder, server_feedback, sizeof(server_feedback), 0);
            printf("%s", server_feedback);
            break;
        } else{
            printf("%s", server_feedback);
        }
        memset(client_input,0, sizeof(client_input));
        fgets(client_input, sizeof(client_input),stdin);
        send(socket_holder,client_input, strlen(client_input),0);
    }
    //operations
    while (1){
        send(socket_holder,"Continue", strlen("Continue"),0);
        memset(server_feedback, 0, sizeof(server_feedback));
        recv(socket_holder, server_feedback, sizeof(server_feedback), 0);
        printf("%s", server_feedback);
        memset(client_input, 0, sizeof(client_input));
        fgets(client_input, sizeof(client_input),stdin);
        send(socket_holder,client_input, strlen(client_input),0);
        memset(server_feedback, 0, sizeof(server_feedback));
        recv(socket_holder, server_feedback, sizeof(server_feedback), 0);
        if(strncmp("No_Input",server_feedback,8)!=0)
            printf("%s",server_feedback);
        if(strncmp("Bye",server_feedback,3)==0)
            break;
    }
    close(socket_holder);
    return 0;
}
