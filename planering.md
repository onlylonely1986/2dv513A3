# Planering
## Page Structure ##
  - Client  
      - ClientView?
          - Add
          - Edit?
          - Remove?
      - Model / DatabasStruktur
          - id
          - name
          - dateOfBirth
          - weight
          - goal

  - Exercise? egen sida?
      - ExerciseView?
      - Model/DatabasStruktur
              - ClientExercise
              - ClientTrainingWeight
              - ClientTrainingReps
              - ClientTrainingResttime

  - Food? egen sida? jag tänker då att man bara ska kunna lägga till mat/exercise när redan en Client är vald,
    så att man vet id det ska kopplas till i DB
      - FoodView
      - Model / DatabasStruktur
          - id?
          - Client_ID? < koppling till Client Foreign KEY?
          - Type?/Name?
          - ClientFoodProtein
          - ClientFoodAmountOfProt och där vikten i gram
          - ClientFoodCarbs 
          - ClientFoodAmountOfCarbs
          - ClientFoodFat  
          - ClientFoodAmountOfFat
              
  - SearchClient?
    - SearchView - sök på Client eller food eller exercise?bara sök på Clientnamn tror jag får räcka
    - SELECT * from Clients where LIKE "%search%" ASC;

### KOMMENTAR
Ska varje food vara kopplat till Klient eller fristående? kopplat
Så fort klienten försvinner så försvinner även maten? japp tänkte jag först, men smartare att inte ha det kopplat till specifik person?
1. Check inputs?
  1. Vilka inputs ska finnas? CRUD? Create, Update, Delete? Vilken sida? 
  * searchview ska visa en lista med Clients (länkarna)
      searchview = Översikt?, Innehåller sökfunktion också/ filtrering?
  * Clientview ska visa en specifik Client och presentera den info som finns om den från DB 
      (man ska även kunna lägga till exercise och food)
      - Specifik Client
  * addClientView är ett formulär att lägga till en ny Client till DB, funkar typ
      - Döp om till AddClientView
      - EditClientView? Slå ihop med och skapa en master ClientView för både ny och edit?
  * exerciseview är ett formulär att lägga till en ny exercise till Client till DB
  * foodview är ett formulär att lägga till en ny food till Client till DB

2. Generate/process data?
  1. Connect to DB?
  2. Generate models to views needed for layoutview?
3. create view ?
  1. LayoutView builds from other views?
  
