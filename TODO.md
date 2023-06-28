Customer Management System for rural supply services WORKSHOP

The 7th of June 2023 to 9th June 2023

Changes on the system

Operator Management

    • Operator on-boarding should be conducted as follows: RURA, as the user responsible for granting access to others for the first time, should create a private operator account. The system will then retrieve data from CLMS to verify if the operator possesses a valid license. Additionally, the RURA user should assign clusters to the operator and associate water supply systems within each cluster.

    • A cluster should have an expiration date. This means that when a cluster is expired, no new billing will be generated. However, payments can still be made for any outstanding bills or charges related to that cluster.

    • The system should register water supply systems ( water networks ) under a cluster 

    • After operator boards, a default user account will be created as the operator admin. This account will have administrative privileges and will serve as the primary user account for the operator. It was decided that the email address to be used is the one in CLMS.  i.e. the step of adding a user on private water operator should be removed. 

    • Logo should be added by the operator. 

    • Operating Area: This will be changed to District.

    • Operator Prefix should be generated automatically by the system. 

    • The system should allow RURA to add grace periods for operators with expired, revoked, suspended licenses.

    • Districts should have the capability to add contracts of  private operators and verify that an operator meets the necessary requirements before commencing operations. This ensures that districts have the necessary documentation and confirmation in place before allowing an operator to begin their operations. WASAC will also be allowed to upload contracts in the system, but these contracts will be verified by RURA. 

Billing

    • In the billing data table, it would be beneficial to include an "Operator" column and a "District" column. These additions would provide important information about the operator associated with each billing entry and the specific district to which the billing belongs.

    • Generating a report of total customers billed based on clusters. 

    • Offline Billing: Orion team to share phone specification and the agreed approach is Billing officers to fetch data on the server while are connected to the internet and from there, they can bill offline and while he/she connected back to the internet data will be synced to the server . 

    • The option for advance payment will be included in the settings module, and the amount specified will be the sales amount excluding VAT. This means that customers can choose to make advance payments for their purchases, and the amount they pay will be based on the sales price without including the VAT.
    • Adding water consumption on invoice 
    • Just showing 5 days records on Billing App 
    • Using both Serial Number and POC for billing 
    • Ability to adjust indices on the admin side ( in case there might be an error)

New Request

    • It has been decided that requesting customers to attach a file of the Unique Parcel Identifier (UPI) is unnecessary.
    • Water usage should be changed to Connection Type 
    • The option of asking if water pipe cross ( Road, Swamp, etc ) should be filled by the technician not the customer .
    • Adding a badge showing number of requests or tasks to work on 
    • Based on the previous information provided, it is determined that connection fees and material fees should be paid separately. The connection fee should be paid first, followed by the payment for the materials.
    • Integration with the National Land Authority would allow us (ORION) to access information related to the Unique Parcel Identifier (UPI) of a customer. This integration would provide us (ORION) with valuable data about the customer's land or property, facilitating when a customer is filling out new connection form.
    • Regarding the billing issue with meters that can count in a reversible way, it is crucial to address this concern. Reversible meters can lead to inaccuracies in billing calculations, as they can count both forward and backward depending on the direction of the flow. 
    • When sending a message to the customer requesting payment for materials, it is important to provide a clear breakdown of what they are paying for. This breakdown should include the itemized list of materials, their quantities, and the corresponding prices. By presenting this information, the customer can review and understand exactly what they are being charged for, ensuring transparency, and facilitating an accurate payment process. The agreed way forward is to include a link in the SMS to minimize number of SMS. 
    • Meter can be transferred to another customer; therefore, the system should support. When meter is transferred arrears are also transferred. 
    • The user should accept terms and conditions for a new connection 
    • If the request is done at the office, attachment of the form should be added . 

Stock Management

    • The module previously known as "Stock Management" will be renamed as "OPM Material Management." This change reflects a shift in focus of materials and supplies management within the OPM (Operations and Maintenance) context.
    • Private water operators typically maintain a central stock at their headquarters, which serves as the main inventory source. This central stock is responsible for supplying other branches or locations with the necessary inventory. On this all the branches must report to the central stock how they handled their stock on different water supply systems.
    • Assessment on how stock item properties should be treated in the system. How the system can capture stock item properties ( i.e., diameter, etc. )
    • Adding Purchase Order and Internal Request in stock management module 

Disconnection Process
• Customer submits a request and then it is reviewed, approved and the customer is disconnected.
• Customer disconnection can also be initiated by the billing officer and there is a reconnection fee attached to that.
This fee is set by the operator.

RRA issue

    • It was agreed that the system should support both at the moment and once law issues are resolved, one option will be disabled. 

Accounting
• Stockout is considered as an expense.
• When an invoice is issued it is considered as a receivable
• Those with Accounting Software they will integrate with us by pushing data from CMS to their system.
•
• Some label modifications:
◦ Starting index======>Previous index.
◦ Latest index======>Current index.
◦ Balance======>Outstanding balance.
◦ Water networks======>Water supply systems.
◦ Consumption will be calculated based on the previous index and the current index. By subtracting the previous index
reading from the current index reading, the difference will determine the consumption for the given period. And must be
displayed.

Public Portal

    • Statistics should be removed and be replaced by Step-by-Step Guide. 
    • Adding A link on CMS for official reports on Water Supply 

Integration to follow up.

    • RDB 
    • Land Information System 
    • Benchmarking Tool 
    • WASAC Customer Feedback System 
    • Mobile money: RURA’s part is not yet decided.
    • LDAP: We are waiting the server from RURA.
    • LODA integration was removed. 


