<?php 

function sideNavigationBar()
{ ?>

<div class="sideNavigationBar menuOption float-left">
    <div class="pl-4 pt-5 navActive">
        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-bar-chart-fill mr-2" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <rect width="4" height="5" x="1" y="10" rx="1" />
            <rect width="4" height="9" x="6" y="6" rx="1" />
            <rect width="4" height="14" x="11" y="1" rx="1" />
        </svg>
        Dashboard
    </div>
    <div class="pl-4 mt-4 menuOptionBar">
        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-book-fill mr-2" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M15.261 13.666c.345.14.739-.105.739-.477V2.5a.472.472 0 0 0-.277-.437c-1.126-.503-5.42-2.19-7.723.129C5.696-.125 1.403 1.56.277 2.063A.472.472 0 0 0 0 2.502V13.19c0 .372.394.618.739.477C2.738 12.852 6.125 12.113 8 14c1.875-1.887 5.262-1.148 7.261-.334z" />
        </svg>
        Programs
        <div class="innerMenu">
            <a href="http://localhost/messystem_beta/dashboard/programs/">
                <p>
                    Programs
                </p>
            </a>
           
            <hr/>
            <a href="http://localhost/messystem_beta/dashboard/course/">
            <p class="">
                Course
            </p>
            </a>
        </div>

    </div>
    <div class="pl-4 mt-4">
        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-bounding-box-circles mr-2"
            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M12.5 2h-9V1h9v1zm-10 1.5v9h-1v-9h1zm11 9v-9h1v9h-1zM3.5 14h9v1h-9v-1z" />
            <path fill-rule="evenodd"
                d="M14 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 11a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM2 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 11a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
        </svg>
        Exam Hall
    </div>
    <div class="pl-4 mt-4">
        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-lines-fill mr-2" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7 1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm2 9a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
        </svg>
        Users
    </div>

</div>
<?php    
}
?>