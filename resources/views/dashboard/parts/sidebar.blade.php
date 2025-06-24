<ul class="metismenu" id="menu">
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bi bi-house-fill"></i>
        </div>
        <div class="menu-title">Dashboard</div>
      </a>

    </li>
     <li class="menu-label">أدوات المسؤول </li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bi bi-droplet-fill"></i>
        </div>
        <div class="menu-title">المستويات</div>
      </a>
       <ul>
        <li> <a href="{{ route( 'dash.grade.index') }}"><i class="bi bi-circle"></i>جميع المستويات</a>
        </li>
        <li> <a href="{{ route('dash.grade.create') }}"><i class="bi bi-circle"></i>اضافة مستوى</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bi bi-basket2-fill"></i>
        </div>
        <div class="menu-title">الشعب</div>
      </a>
      <ul>
        <li> <a href={{ route('dash.section.index') }}><i class="bi bi-circle"></i>جميع الشعب</a>
        </li>
        </li>
      </ul>
    </li>
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="bi bi-award-fill"></i>
        </div>
        <div class="menu-title">المعلمين</div>
      </a>
      <ul>
        <li> <a href={{ route('dash.teacher.index') }}><i class="bi bi-circle"></i>جميع المعلمين</a>
        </li>

      </ul>
    </li>
    <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="bi bi-cloud-arrow-down-fill"></i>
        </div>
        <div class="menu-title">المحاضرات</div>
      </a>
      <ul>
         <li> <a href={{ route('dash.lecture.index') }}><i class="bi bi-circle"></i>جميع المحاضرات</a>
        </li>
  </ul>

   <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="bi bi-cloud-arrow-down-fill"></i>
        </div>
        <div class="menu-title">الطلاب</div>
      </a>
      <ul>
         <li> <a href={{ route('dash.student.index') }}><i class="bi bi-circle"></i>جميع الطلاب</a>
        </li>
  </ul>

   <li>
      <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="bi bi-cloud-arrow-down-fill"></i>
        </div>
        <div class="menu-title">المواد الدراسية</div>
      </a>
      <ul>
         <li> <a href={{ route('dash.subject.index') }}><i class="bi bi-circle"></i>جميع المواد الدراسية</a>
        </li>
  </ul>
