		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-primary">
						<li class="nav-item active">
							<a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="dashboard">
								<ul class="nav nav-collapse">
									<li>
										<a href="#">
											<span class="sub-item">Data Masyayikh</span>
										</a>
									</li>
									<li>
										<a href="#">
                                            <span class="sub-item">Data Asatidz</span>
										</a>
									</li>
                                    <li>
										<a href="#">
                                            <span class="sub-item">Data Santri</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
                        <li class="nav-item">
							<a data-toggle="collapse" href="#sidebarLayouts">
								<i class="fas fa-th-list"></i>
								<p>Master Data</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="sidebarLayouts">
								<ul class="nav nav-collapse">
                                    @if (Auth::user()->role == 'ADMIN')
                                    <li>
										<a href="{{ route('user.index') }}">
											<span class="sub-item">User</span>
										</a>
									</li>
                                    @endif

									{{-- <li>
										<a href="{{ route('profile.index') }}">
											<span class="sub-item">Profile</span>
										</a>
									</li> --}}
									{{-- <li>
										<a href="{{ route('category.index') }}">
											<span class="sub-item">Category</span>
										</a>
									</li>
                                    <li>
										<a href="{{ route('slideshow.index') }}">
											<span class="sub-item">Slideshow</span>
										</a>
									</li>
                                    <li>
										<a href="{{ route('contact.index') }}">
											<span class="sub-item">Contact</span>
										</a>
									</li> --}}
									<li>
										<a href="{{ route('dormitory.index') }}">
											<span class="sub-item">Komplek</span>
										</a>
									</li>
									<li>
										<a href="{{ route('room.index') }}">
											<span class="sub-item">Kamar</span>
										</a>
									</li>
									<li>
										<a href="{{ route('role.index') }}">
											<span class="sub-item">Status</span>
										</a>
									</li>
									<li>
										<a href="{{ route('season.index') }}">
											<span class="sub-item">Tahun Ajaran</span>
										</a>
									</li>
									<li>
										<a href="{{ route('grade.index') }}">
											<span class="sub-item">Kelas</span>
										</a>
									</li>
									<li>
										<a href="{{ route('bill.index') }}">
											<span class="sub-item">Tagihan</span>
										</a>
									</li>
                                    <li>
										<a href="{{ route('student.index') }}">
											<span class="sub-item">Santri</span>
										</a>
									</li>
                                    <li>
										<a href="{{ route('teacher.index') }}">
											<span class="sub-item">Asatidz</span>
										</a>
									</li>
                                    <li>
										<a href="{{ route('lesson.index') }}">
											<span class="sub-item">Mata Pelajaran</span>
										</a>
									</li>
                                    <li>
										<a href="{{ route('lesson-value.index') }}">
											<span class="sub-item">Nilai</span>
										</a>
									</li>
                                    <li>
										<a href="{{ route('foul.index') }}">
											<span class="sub-item">Pelanggaran</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

						<li class="nav-item">
							<a data-toggle="collapse" href="#base">
								<i class="fas fa-pen-square"></i>
								<p>Postingan</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{ route('article.index') }}">
											<span class="sub-item">Article</span>
										</a>
									</li>

								</ul>
							</div>
						</li>

					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->
