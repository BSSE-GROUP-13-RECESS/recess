#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <ctype.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <unistd.h>
#include <arpa/inet.h>
#include <sys/types.h>
#include <pthread.h>

#define PORT 9025
#define DIRECTORY1 "enrollment_files/" //directory for enrollment files
#define DIRECTORY2 "submitted_files/" //directory for submitted files

void *processing(void *sock);
int dateValidate(char *);
int fetchFromFile(char *, char dest_file[]);
int countCases(char file_name[]);
char *searchFunction(char *, char file_name[]);
char *saveToFile(char str[], char file_name[]);
char *verify_district(char str[]);

enum YEAR_TYPE{
    LEAP, NOT_LEAP
};

struct FILE_STRUCTURE{
    char firstname[30];
    char lastname[30];
    char date[15];
    char gender[5];
    char category[15];
    char username[30];
};

int main(void){
    struct sockaddr_in server_address;
    int server_socket, opt=1, client_socket;
    int address_length = sizeof(server_address);

    // Creating socket based on TCP
    if ((server_socket = socket(AF_INET, SOCK_STREAM, 0))<0){
        perror("Failed to create socket.");
        exit(EXIT_FAILURE);
    }
    //Forcefully attaching socket to port
    if (setsockopt(server_socket, SOL_SOCKET, SO_REUSEADDR | SO_REUSEPORT,&opt, sizeof(opt))<0){
        perror("Failed to attach socket");
        exit(EXIT_FAILURE);
    }
    //creating address for the socket
    server_address.sin_family = AF_INET;
    server_address.sin_addr.s_addr = INADDR_ANY;
    server_address.sin_port = htons(PORT);
    // binding server to socket
    if (bind(server_socket, (struct sockaddr *) &server_address, sizeof(server_address))<0){
        perror("Failed to bind server to socket.");
        exit(EXIT_FAILURE);
    }
    //listening for incoming connections
    if (listen(server_socket, 5) < 0){
        perror("Failed to listen for incoming connections");
        exit(EXIT_FAILURE);
    }
    while (1){
        //accepting a connection
        if ((client_socket = accept(server_socket, (struct sockaddr *)&server_address,(socklen_t*)&address_length))<0){
            perror("accept");
            exit(EXIT_FAILURE);
        }
        //accepting many clients using multi threads
        pthread_t thread_id;
        int *new_client = malloc(sizeof(int));
        *new_client = client_socket;
        pthread_create(&thread_id, NULL, processing,new_client);
    }
}

void *processing(void *sock){
    int client_sock = *((int*)sock);//casting void pointer to int pointer
    free(sock);//copying and freeing the passed pointer
    //data interchange with client
    char server_reply[13000], client_input[150], *district, dist[40], username[30], filename[60];
    char line[100], fileLines[10000];
    char *args, *command, *passedArgs[4], cleanedArgs[100];
    char temp_user[29], *tempUse;
    memset(temp_user,0, sizeof(temp_user));
    memset(username,0, sizeof(username));
    int argsCount, update = 0;
    memset(fileLines,0, sizeof(fileLines));
    memset(server_reply,0, sizeof(server_reply));
    sprintf(server_reply,"Client Program v1.0\n(c) 2021 BSSE GROUP 13. "
                         "All rights reserved.\n\nEnter your district: ");
    send(client_sock, server_reply, strlen(server_reply), 0);
    //storing and validating district
    while (1){
        memset(dist,0, sizeof(dist));
        recv(client_sock, dist, sizeof(dist), 0);
        //if the district is a valid one
        if((district=verify_district(dist))!=NULL){
            //set the file name that health worker uses
            memset(filename,0, sizeof(filename));
            sprintf(filename,"%s%s_enroll.txt",DIRECTORY1,district);
            memset(server_reply,0, sizeof(server_reply));
            sprintf(server_reply,"Your district is: %s.\n\nCommands that can be used include;-\n"
                                 "Addpatient - To add patients like this [Addpatient patient_name, date, gender, category]\n"
                                 "           - To add patients from a file like this [Addpatient.txt]\n"
                                 "Addpatientlist - To add the patient list to the patient file\n"
                                 "Check_status - To check status of the file\n"
                                 "Search - To search a record by either name or date like this [Search \"name\" or \"yyyy-mm-dd\"]\n"
                                 "Exit - To close the application\n\nNotes:\n"
                                 "Dates must be written as yyyy-mm-dd\n"
                                 "Username must be of a registered health officer\n"
                                 "Gender written as \'M\' or \'F\'\n"
                                 "Category is either asymptomatic or symptomatic\n"
                                 "-------------------------------------------------------------------------------------\n\n"
                                 "Please enter a valid username: ",district);
            send(client_sock, server_reply, strlen(server_reply), 0);
            recv(client_sock, temp_user, sizeof(temp_user),0);
            tempUse = strtok(temp_user,"\n");
            sprintf(username,"%s",tempUse);
            memset(server_reply,0, sizeof(server_reply));
            sprintf(server_reply,"\nYour username is: %s.\n\n",username);
            send(client_sock, server_reply, strlen(server_reply), 0);
            break;
        }
        send(client_sock,"Please enter a valid district: ", 35,0);
    }
    //major operations
    while (1){
        recv(client_sock, client_input, sizeof(client_input),0);
        send(client_sock, "client>", strlen("client>"), 0);
        memset(server_reply,0, sizeof(server_reply));
        memset(client_input, 0, sizeof(client_input));
        memset(cleanedArgs, 0, sizeof(cleanedArgs));
        memset(passedArgs, 0, sizeof(passedArgs));
        memset(line,0, sizeof(line));
        recv(client_sock, client_input, sizeof(client_input),0);
        command = strtok(client_input, " ");
        args = strtok(NULL, "\n");
        if(strlen(command) > 1 && args == NULL) {
            command = strtok(command, "\n");
        }
        else if (args != NULL) {
            for (int i=0, x=0; i<strlen(args); i++){
                if ((x>0&&i>0&&i<strlen(args)-1&&isspace(args[i])!=0&&isalnum(args[i+1])!=0&&
                     isalnum(cleanedArgs[x-1])!=0)||isspace(args[i])==0){
                    strncat(cleanedArgs, &args[i], 1);
                    x++;
                }
            }
        }
        if (strcmp(command, "Addpatientlist")==0){
            if(update==1){
                sprintf(server_reply,"%s\n",saveToFile(fileLines,filename));
                memset(fileLines,0, sizeof(fileLines));
                update=0;
            }else if(strlen(cleanedArgs)>=1){
                sprintf(server_reply,"You dont need to pass arguments to this command.\n"
                                     "There are no records awaiting to be saved.\n");
            }else{
                sprintf(server_reply,"There are no records awaiting to be saved.\n");
            }
        }
        else if (strcmp(command, "Addpatient")==0){
            if(strlen(cleanedArgs)==0){
                sprintf(server_reply, "Error: No arguments were passed!\n");
            }
            if (args != NULL){
                for (int i = 0; i < 5; i++){
                    (i == 0)?(passedArgs[i] = strtok(cleanedArgs, ",")):(passedArgs[i] = strtok(NULL, ","));
                    if(passedArgs[i] == NULL) {
                        argsCount = i-1;
                        break;
                    } else{
                        argsCount = i;
                    }
                }
                if(argsCount == 0){
                    int addCount = countCases(filename);
                    if(fetchFromFile(passedArgs[0], filename)==1){
                        sprintf(server_reply,"Operation successful. The records(%d) were added to target file.\n",
                                countCases(filename)-addCount);
                    }else{
                        sprintf(server_reply,"Error: Either source or target file could not be opened or does not exist.\n");
                    }
                }
                else if(argsCount == 3){
                    if (dateValidate(passedArgs[1])==1){
                        passedArgs[1][4] = '-';
                        passedArgs[1][7] = '-';
                        if(strlen(passedArgs[2])!=1){
                            sprintf(server_reply,"Error: Gender must have one character, either 'M' or 'F'.\n");
                        }
                        else if(toupper(passedArgs[2][0])=='M'||toupper(passedArgs[2][0])=='F') {
                            if((strncmp(passedArgs[3],"symptomatic",11)==0)|| (strncmp(passedArgs[3],"asymptomatic",12)==0)) {
                                update = 1;
                                sprintf(line, "%s,%s,%c,%s,%s\n", passedArgs[0], passedArgs[1], toupper(passedArgs[2][0]),
                                        passedArgs[3],username);
                                strcat(fileLines, line);
                                sprintf(server_reply, "Record submitted, waiting to be saved with ->Addpatientlist\n");
                            } else{
                                sprintf(server_reply,"Error: Category must be either symptomatic or asymptomatic.\n");
                            }
                        }else{
                            sprintf(server_reply,"Error: Gender must be either 'M' or 'F'.\n");
                        }
                    }else if(dateValidate(passedArgs[1])==-2){
                        sprintf(server_reply,"Error: In the given date, the day of the month does not exist.\n");
                    }
                    else{
                        sprintf(server_reply,"Error: Invalid date. Record not taken\n");
                    }
                }
                else if(argsCount <3 && argsCount>0){
                    sprintf(server_reply,"Error: You supplied %d arguments.\n"
                                         "Please supply either 1(one->a filename) or 4(four) arguments.\n", argsCount+1);
                }
                else if(argsCount >3){
                    sprintf(server_reply,"Error: You supplied more than 4(four) arguments.\n"
                                         "Please supply either 1(one->a filename) or 4(four) arguments.\n");
                }
            } else{
                sprintf(server_reply,"Error: You did not supply any arguments.\n");
            }
        }
        else if (strcmp(command, "Check_status")==0){
            (countCases(filename)==-1)?sprintf(server_reply,"File could not be opened or does not exist.\n"):sprintf(server_reply,"Patient file has %d cases.\n",countCases(filename));
        }
        else if (strcmp(command, "Search")==0){
            (args==NULL)?sprintf(server_reply,"Error: You did not provide a search criteria.\n"):sprintf(server_reply,"%s\n", searchFunction(cleanedArgs,filename));
        }
        else if (strcmp(command, "Exit")==0 || strcmp(command, "exit")==0) {
            sprintf(server_reply,"Bye\n");
            send(client_sock, server_reply, strlen(server_reply), 0);
            close(client_sock);
            break;
        }
        else if (strlen(command) > 1||(strlen(command)==1&&isspace(command[0])==0)){
            sprintf(server_reply,"Error: Unknown command --> [%s]\n", command);
        }else{
            sprintf(server_reply,"No_Input");
        }
        send(client_sock, server_reply, strlen(server_reply), 0);
    }
    return NULL;
}

int fetchFromFile(char *src_file, char dest_file[]){
    struct FILE_STRUCTURE pips[100];
    int i = 0;
    char filedir[60];
    memset(filedir,0, sizeof(filedir));
    sprintf(filedir,"%s%s",DIRECTORY2,src_file);
    FILE *src = fopen(filedir, "r");
    FILE *dest = fopen(dest_file, "a+");
    if (src!=NULL&&dest!=NULL){
        while(!feof(src)){
            fscanf(src, "%s%s%s%s%s%s", pips[i].firstname,pips[i].lastname,pips[i].date,pips[i].gender,pips[i].category,pips[i].username);
            fprintf(dest, "%s %s,%s,%s,%s,%s\n",pips[i].firstname,pips[i].lastname,pips[i].date,pips[i].gender,pips[i].category,pips[i].username);
            i++;
        }
        fclose(src);
        fclose(dest);
        return 1;
    }else{
        return 0;
    }
}

int dateValidate(char *dt){
    char date[10];
    enum YEAR_TYPE yearType;
    char *date_parts[3];
    int year;
    int month;
    int day;
    memset(date, 0, sizeof(date));
    memset(date_parts, 0, sizeof(date_parts));
    if (strlen(dt) == 10) {
        strncpy(date, dt, 10);
        date[4] = '-';
        date[7] = '-';
        date_parts[0] = strtok(date, "-");
        date_parts[1] = strtok(NULL, "-");
        date_parts[2] = strtok(NULL, "-");
        for (int i = 0; i < 3; i++) {
            if (date_parts[i] != NULL) {
                for (int j = 0; j < strlen(date_parts[i]); j++) {
                    if (isdigit(date_parts[i][j]) == 0) {
                        return -1;
                    }
                }
                if (i == 0) {
                    year = atoi(date_parts[i]);
                    if (year % 4 == 0) {
                        if (year % 100 == 0) {
                            if (year % 400 == 0) {
                                yearType = LEAP;
                            } else {
                                yearType = NOT_LEAP;
                            }
                        } else {
                            yearType = LEAP;
                        }
                    } else {
                        yearType = NOT_LEAP;
                    }
                }
                if (i == 1) {
                    month = atoi(date_parts[i]);
                }
                if (i == 2) {
                    day = atoi(date_parts[i]);
                    switch (month) {
                        case 1:
                        case 3:
                        case 5:
                        case 7:
                        case 8:
                        case 10:
                        case 12:
                            if (day > 31) {
                                return -2;
                            }
                            break;
                        case 4:
                        case 6:
                        case 9:
                        case 11:
                            if (day > 30) {
                                return -2;
                            }
                            break;
                        case 2:
                            if ((yearType == LEAP && day > 29) || (yearType == NOT_LEAP && day > 28)) {
                                return -2;
                            }
                            break;
                        default:
                            return -1;
                    }
                }

            } else {
                return -1;
            }
        }
    } else {
        return -1;
    }
    return 1;
}

int countCases(char file_name[]){
    int caseCount = 0;
    FILE *en = fopen(file_name, "r");
    char newline;
    if (en!=NULL){
        while(!feof(en)){
            newline = getc(en);
            if(newline == '\n'){caseCount++;}
        }
        fclose(en);
        return caseCount;
    }else{
        return -1;
    }
}

char *searchFunction(char *criteria, char file_name[]){
    char string[150], temp[150], temp_criteria[50], messageArray[13000], temp_message[13030], *date, *name, *message;
    int appearance=0, i=0;
    memset(temp_criteria,0, sizeof(temp_criteria));
    for (int j=0;j<strlen(criteria)&&j<50;j++){
        temp_criteria[j] = tolower(criteria[j]);
    }
    if((criteria = strtok(temp_criteria, ""))==NULL){
        return "No results found.";
    }
    memset(messageArray,0, sizeof(messageArray));
    FILE *en = fopen(file_name, "r");
    if (en!=NULL){
        while (!feof(en)) {
            memset(string,0, sizeof(string));
            memset(temp,0, sizeof(temp));
            fgets(string, sizeof(string),en);
            for(int z=0;z<strlen(string);z++){
                temp[z] = tolower(string[z]);
            }
            name = strtok(temp, ",");
            date = strtok(NULL, ",");
            if((name!=NULL)&&(strstr(name, criteria)!=NULL||strstr(date, criteria)!=NULL)){
                strcat(messageArray,string);
            }
        }
        fclose(en);
    }else{
        return "File could not be opened";
    }
    if(strlen(messageArray)>2){
        while (messageArray[i]!='\0'){
            if(messageArray[i]=='\n'){
                appearance++;
            }
            i++;
        }
        sprintf(temp_message,"%s....%d result(s) found....",messageArray, appearance);
        message = strtok(temp_message,"\0");
        if(message!=NULL) {
            return message;
        }
    }
    return "No results found.";
}

char *saveToFile(char str[], char file_name[]){
    int number;
    char messageArray[40];
    if((number = countCases(file_name))==-1)
        number = 0;
    FILE *en = fopen(file_name, "a+");
    if (en!=NULL){
        fprintf(en, "%s", str);
        fclose(en);
        number = countCases(file_name)-number;
        if (number>0){
            sprintf(messageArray, "...%d Record(s) saved to file...",number);
            char *message = strtok(messageArray,"\0");
            if(message!=NULL){
                return message;
            }
        }
    }else{
        return "Failed to open target file.";
    }
    return "Save Failure! No records were saved";
}

char *verify_district(char *str){
    char district[25], dist[25];
    memset(district,0, sizeof(district));
    char *districts[] = {"Abim","Adjumani","Agago","Alebtong","Amolatar","Amudat","Amuria","Amuru","Apac",
                         "Arua","Budaka","Bududa","Bugiri","Bugweri","Buhweju","Buikwe","Bukedea","Bukomansimbi","Bukwo",
                         "Bulambuli","Buliisa","Bundibugyo","Bunyangabu","Bushenyi","Busia","Butaleja","Butambala","Butebo",
                         "Buvuma","Buyende","Dokolo","Gomba","Gulu","Hoima","Ibanda","Iganga","Isingiro","Jinja","Kaabong","Kabale",
                         "Kabarole","Kaberamaido","Kagadi","Kakumiro","Kalangala","Kaliro","Kalungu","Kampala","Kamuli","Kamwenge","Kanungu",
                         "Kapchorwa","Kapelebyong","Karenga","Kasanda","Kasese","Katakwi","Kayunga","Kazo","Kibaale","Kiboga","Kibuku",
                         "Kigezi","Kikuube","Kiruhura","Kiryandongo","Kisoro","Kitagwenda","Kitgum","Koboko","Kole","Kotido","Kumi","Kwania",
                         "Kween","Kyankwanzi","Kyegegwa","Kyenjojo","Kyotera","Lamwo","Lira","Luuka","Luweero","Lwengo","Lyantonde","Manafwa",
                         "Maracha","Masaka","Masindi","Mayuge","Mbale","Mbarara","Mitooma","Mityana","Moroto","Moyo","Mpigi","Mubende","Mukono",
                         "Nabilatuk","Nakapiripirit","Nakaseke","Nakasongola","Namayingo","Namisindwa","Namutumba","Napak","Nebbi","Ngora",
                         "Ntoroko","Ntungamo","Nwoya","Obongi","Omoro","Otuke","Oyam","Pader","Pakwach","Pallisa","Rakai","Rubanda","Rubirizi","Rukiga",
                         "Rukungiri","Rwampara","Sembabule","Serere","Sheema","Sironko","Soroti","Terego","Tororo","Wakiso","Yumbe","Zombo"};

    for (int i=0,x=0;i<strlen(str);i++){
        if(isalpha(str[i])) {
            district[x] = tolower(str[i]);
            x++;
        }
    }
    for (int i=0;i<135;i++){
        memset(dist,0, sizeof(dist));
        strcpy(dist,districts[i]);
        dist[0] = tolower(dist[0]);
        if(strcmp(dist,district)==0){
            return districts[i];
        }
    }
    return NULL;
}